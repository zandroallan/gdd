<div class="small-header">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-left">
                <h2 class="font-light m-b-xs">
                    {!! $titulo !!}
                </h2>
                <ol class="hbreadcrumb breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </div>

            <div id="" class="heading_actions">                  
                    @yield('buttons')
            </div>
        </div>
    </div>
</div>