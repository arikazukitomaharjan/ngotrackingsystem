@extends('admin.app')
@section('content')
<div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                
                                    <h4 class="panel-title"> Pages <a href="{{ URL::route('createPage') }}">Add New</a></h4>
                               
                                </div>
                                <div class="panel-body">
                                   
                                   <div class="table-responsive">
                                    <div id="example-editable_wrapper" class="dataTables_wrapper">
                                 
                                 <!-- 
                                   <div class="dataTables_length" id="example-editable_length">
                                    <label>Show 
                                    <select name="example-editable_length" aria-controls="example-editable" class="">
                                    <option value="10">10</option>
                                    <option value="25">25</option><option value="50">50</option>
                                    <option value="100">100</option>
                                    </select> entries
                                    </label>
                                    </div>
                                    <div id="example-editable_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="" placeholder="" aria-controls="example-editable"></label>
                                    </div>  
                                    -->

                                    <table id="example-editable" class="display table dataTable" style="width: 100%;" role="grid" aria-describedby="example-editable_info">
                                        <thead>
                                           <tr>
                                                <th rowspan="1" colspan="1">Page Title</th>
                                                <th rowspan="1" colspan="1">Last Updated</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                      </thead>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Page Title</th>
                                                <th rowspan="1" colspan="1">Last Updated</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                         @foreach($pageList as $page)
                                       <tr role="row" class="odd">
                                            <td class="sorting_1"><a href="{{ URL::route('editPage', array( $page->id )) }}" class="editable editable-click">{{ $page->title }}</a></td>
                                          
                                            
                    
                                            <td><a href="javascript:void(0);" class="editable editable-click">{{ date('F d, Y', strtotime($page->updated_at)) }}</a></td>
                                             <td><a href="{{ URL::route('deletePage', array(  $page->id )) }}" onClick="return confirm('Are you sure?');" class="editable editable-click">Delete</a></td>
                                        </tr>
                                        @endforeach
                                            </tbody>
                                       </table>
                                     <!--  <div class="dataTables_info" id="example-editable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries
                                       </div>
                                       <div class="dataTables_paginate paging_simple_numbers" id="example-editable_paginate"><a class="paginate_button previous disabled" aria-controls="example-editable" data-dt-idx="0" tabindex="0" id="example-editable_previous">Previous</a><span><a class="paginate_button current" aria-controls="example-editable" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="example-editable" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button " aria-controls="example-editable" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button " aria-controls="example-editable" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button " aria-controls="example-editable" data-dt-idx="5" tabindex="0">5</a><a class="paginate_button " aria-controls="example-editable" data-dt-idx="6" tabindex="0">6</a></span><a class="paginate_button next" aria-controls="example-editable" data-dt-idx="7" tabindex="0" id="example-editable_next">Next</a>
                                       </div> -->

                                       </div>  
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    </div><!-- Row -->
                </div>

            @stop

         {!! Html::script( 'resources/assets/plugins/jquery/jquery-2.1.4.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-ui/jquery-ui.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/pace-master/pace.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-blockui/jquery.blockui.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap/js/bootstrap.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/switchery/switchery.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/uniform/jquery.uniform.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/offcanvasmenueffects/js/classie.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/waves/waves.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/3d-bold-navigation/js/main.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/jquery-mockjax-master/jquery.mockjax.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/moment/moment.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/datatables/js/jquery.datatables.min.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js', [ 'defer' => 'defer' ] ) !!}
         {!! Html::script( 'resources/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', [ 'defer' => 'defer' ] ) !!} 
         {!! Html::script( 'resources/assets/js/modern.min.js', [ 'defer' => 'defer' ] ) !!}
        <!-- {!! Html::script( 'resources/assets/js/pages/table-data.js', [ 'defer' => 'defer' ] ) !!} -->
        

