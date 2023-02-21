<?php
namespace App\Http\Controllers;
use App\Helpers\MailerFactory;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\User;
// use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('admin:index-list_projects|create-create_project|show-view_project|edit-edit_project|destroy-delete_document', ['except' => ['store', 'update']]);
        $this->mailer = $mailer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $query =Project::where('name', 'like', "%$keyword%");
        } else {
            $query =Project::latest();
        }
       // if not is admin user
    //    if (Auth::user()->is_admin == 0) {
    //        $query->where('user_id', Auth::user()->id)
    //            ->orWhere('user_id', Auth::user()->id);

    //    }

    
        $projects = $query->paginate($perPage);
        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $project_status = ProjectStatus::all();
        $users = User::all();
        return view('pages.projects.create', compact('project_status', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // $this->do_validate($request);

        $requestData = $request->except(['_token']);
        checkDirectory("projects");
        $requestData['user_id'] = Auth::user()->id;
        $project = Project::create($requestData);

        if ($request->hasFile('image')) {

            checkDirectory("projects");

            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/projects'));
        }
        return redirect('admin/projects')->with('flash_message', 'Project added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $project_status = ProjectStatus::all();
        $users = User::all();
        return view('pages.projects.edit', compact('project', 'project_status', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        // $this->do_validate($request, 0);
        $requestData = $request->except(['_token']);
        // if ($request->hasFile('file')) {
        //     checkDirectory("files");
        //     $requestData['file'] = uploadFile($request, 'file', public_path('uploads/files'));
        // }
$requestData['modified_by_id'] = Auth::user()->id;

        $project = Project::findOrFail($id);
        $old_user_id = $project->user_id;
        $project->update($requestData);
        if (isset($requestData['user_id']) && $old_user_id != $requestData['user_id'] && getSetting("enable_email_notification") == 1) {
            $this->mailer->sendAssignDocumentEmail("File assigned to you", User::find($requestData['user_id']), $project);
        }
        return redirect('admin/projects')->with('flash_message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('admin/projects')->with('flash_message', 'Project deleted!');
    }

   


 
}