
{{--<div class="sidebar-menu" data-widget="tree">--}}
    {{--            <li class="header">MAIN NAVIGATION</li>--}}
<section>
    <div class="row">
        <div class="col-sm-2 ">
            <div class="small-box bg-green">
            <a href="{{ url('admin/files') }}" class="small-box-footer">{{count(getFiles()) }}<br>All Files </a>
            </div>
    </div>
        <div class="col-sm-2">
            <div class="small-box bg-green">
             <a href="{{ url('admin/files?type_name=Hr Files') }}" class="small-box-footer">{{count(getFiles('Hr Files'))}}<br>Hr Files </a>
            </div>
            </div>

        <div class="col-sm-2 ">
            <div class="small-box bg-green">
            <a href="{{ url('admin/files?type_name=Policy') }}" class="small-box-footer">{{count(getFiles('Policy'))}}<br>Policy</a>
            </div>
            </div>
        <div class="col-sm-2">
            <div class="small-box bg-green">
            <a href="{{ url('admin/files?type_name=Property') }}" class="small-box-footer">{{count(getFiles('Property'))}}<br>Property</a>
            </div>
            </div>

        <div class="col-sm-2 ">
            <div class="small-box bg-green">
            <a href="{{ url('admin/files?type_name=Loan Forms') }}" class="small-box-footer">{{count(getFiles('Loan Forms'))}}<br>Loan Forms </a>
                </div>
            </div>
        <div class="col-sm-2 ">
            <div class="small-box bg-green">
                <a href="{{ url('admin/files?type_name=Finance') }}" class="small-box-footer">{{count(getFiles('Finance'))}}<br>Finance </a>
            </div>
        </div>


    </div>
</section>