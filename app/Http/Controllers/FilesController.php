<?php
namespace App\Http\Controllers;
use App\Helpers\MailerFactory;
use App\Models\File;
use App\Models\FileType;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FilesController extends Controller
{
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('admin:index-list_documents|create-create_document|show-view_document|edit-edit_document|destroy-delete_document', ['except' => ['store', 'update']]);
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
            $query =File::where('name', 'like', "%$keyword%");
        } else {
            $query =File::latest();
        }
          if(\request('type_name') != null) {
            $query->where('type', '=', FileType::where('name', \request('type_name'))->first()->id);
        }
        $files = $query->paginate($perPage);
        return view('pages.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $file_types = FileType::all();
        $users = User::all();
        return view('pages.files.create', compact('file_types', 'users'));
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
        $this->do_validate($request);

        $requestData = $request->except(['_token']);
        checkDirectory("files");
        $requestData['file'] = uploadFile($request, 'file', public_path('uploads/files'));
        $requestData['user_id'] = Auth::user()->id;
        $file = File::create($requestData);
        if (isset($requestData['user_id']) && getSetting("enable_email_notification") == 1) {
            $this->mailer->sendAssignDocumentEmail("File assigned to you", User::find($requestData['user_id']), $file);
        }
        return redirect('admin/files')->with('flash_message', 'File added!');
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
        $file = File::findOrFail($id);
        return view('pages.files.show', compact('file'));
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
        $file = File::findOrFail($id);
        $file_types = FileType::all();
        $users = User::all();
        return view('pages.files.edit', compact('file', 'file_types', 'users'));
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
        $this->do_validate($request, 0);
        $requestData = $request->except(['_token']);
        if ($request->hasFile('file')) {
            checkDirectory("files");
            $requestData['file'] = uploadFile($request, 'file', public_path('uploads/files'));
        }
        $requestData['modified_by_id'] = Auth::user()->id;

        $file = File::findOrFail($id);
        $old_user_id = $file->user_id;
        $file->update($requestData);
        if (isset($requestData['user_id']) && $old_user_id != $requestData['user_id'] && getSetting("enable_email_notification") == 1) {
            $this->mailer->sendAssignDocumentEmail("File assigned to you", User::find($requestData['user_id']), $file);
        }
        return redirect('admin/files')->with('flash_message', 'File updated!');
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
        File::destroy($id);
        return redirect('admin/files')->with('flash_message', 'file deleted!');
    }

    public function getAssignDocument($id)
    {
        $file = File::find($id);
        $users = User::where('id', '!=', $file->user_id)->get();
        return view('pages.files.assign', compact('users', 'file'));
    }

//    public function postAssignDocument(Request $request, $id)
//
//        $this->validate($request, [
//            'assigned_user_id' => 'required'
//        ]);
//        $document = Document::find($id);
//        $document->update(['assigned_user_id' => $request->assigned_user_id]);
//        if (getSetting("enable_email_notification") == 1) {
//            $this->mailer->sendAssignDocumentEmail("Document assigned to you", User::find($request->assigned_user_id), $document);
//        }
//        return redirect('admin/documents')->with('flash_message', 'Document assigned!');
//    }

    protected function do_validate($request, $is_create = 1)
    {
        $mimes = 'mimes:jpg,jpeg,png,gif,pdf,doc,docx,txt,xls,xlsx,odt,dot,html,htm,rtf,ods,xlt,csv,bmp,odp,pptx,ppsx,ppt,potm';
        $this->validate($request, [
            'name' => 'required',
            'file' => ($is_create == 0 ? $mimes : "required|" . $mimes)
        ]);
    }
    public function getFilesByStatus(Request $request)
    {
        if(!$request->status)
            return [];
        $files = File::where('file_type.name', $request->status)
            ->join('file_type', 'file_type.id', '=', 'files.type');
//        if(Auth::user()->is_admin == 1) {
//            return $contacts->get();
////        }
        return $files->where(function ($query) {
            $query->where('assigned_user_id', Auth::user()->id)
                ->orWhere('created_by_id', Auth::user()->id);
        })->get();
    }

}

