@extends('admin')
@section('content')
    <div class="site_body">
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">All Organization</h1>

                <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createOrganization') }}"
                                                      class="btn btn_green">Add new</a></span>

            </div>


            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>
                        <th>S. N.</th>
                        <th>Name</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="actions">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($dataList as $row)
                        <?php
                        $orgLink = url('/organizations/' . $row->id);
                        $editLink = url('/organizations/edit/' . $row->id);
                        $deleteLink = url('/organizations/delete/' . $row->id);
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{$orgLink}}"> {{ $row->name }} </a></td>
                            <td> NPR {{ $obj->getBudgetByOrganization( $row->id ) }} </td>
                            <td> {{ $row->status }} </td>
                            <td>
                                <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                    <!--ActionBtns-->
                                    <span class="actions_wrapp">
                                        <a href="{{$editLink}}" class="fa fa-pencil-square-o" aria-hidden="true"></a>
                                        <a href="{{$orgLink}}" class="fa fa-eye" aria-hidden="true"></a>
                                        <a onclick="return confirm('Are you sure? You can\'t undo this action.')"
                                           href="{{$deleteLink}}" class="fa fa-trash-o" aria-hidden="true"></a>
                                    </span>

                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach


                    </tbody>
                    <tfoot>


                </table>
                <div class="grid_pagination">
                    <ul class="ftr_sort">
                        <li class="pull-left">
                            Showing <strong>{{ $dataList->currentPage() }} </strong> of {{ $dataList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                            <select id="row-view-select">
                               <option {{ $view==10?'selected':'' }} value="{{ url('organizations/budget?view=10') }}">10</option>
                        <option {{ $view==25?'selected':'' }} value="{{ url('organizations/budget?view=25') }}">25</option>
                        <option {{ $view==50?'selected':'' }} value="{{ url('organizations/budget?view=50') }}">50</option>
                        <option {{ $view==100?'selected':'' }} value="{{ url('organizations/budget?view=100') }}">100</option>
                            </select>
                        </span></li>
                    </ul>
                    <ul>
                        <li><a href="{!! $dataList->previousPageUrl()!!}">Prev</a></li>
                        <li>{!!  str_replace('/?', '?', $dataList->appends(['view' => $view ])->render()) !!}</li>
                        <li><a href="{!! $dataList->nextPageUrl()!!}">Next</a></li>

                    </ul>
                </div>
            </div>

    </div>

@stop



         