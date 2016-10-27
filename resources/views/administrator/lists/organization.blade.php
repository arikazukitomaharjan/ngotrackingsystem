@extends('administrator')
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
                        <th>Address</th>
                        <th>Contact Person</th>
                        <th>Status</th>


                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($dataList as $row)
                        <?php
                        $orgLink = url('/administrator/organization/view/' . $row->id);
                        $editLink = url('/organizations/edit/' . $row->id);
                        $deleteLink = url('/organizations/delete/' . $row->id);
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href="{{$orgLink}}"> {{ $row->name }} </a></td>
                            <td> {{ $row->address }} </td>
                            <td> {{ $row->contact_person }} </td>
                            <td> {{ $row->status }} </td>

                        </tr>
                        <?php $i++; ?>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <?php
                    $view = Request::get('view');
                    if (!$view) {
                        $view = 10;
                    }
                    ?>


                </table>
                <div class="grid_pagination">
                    <ul class="ftr_sort">
                        <li class="pull-left">
                            Showing <strong>{{ $dataList->currentPage() }} </strong> of {{ $dataList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                            <select id="row-view-select">
                               <option {{ $view==10?'selected':'' }} value="{{ url('/administrator/organization?view=10') }}">10</option>
            <option {{ $view==25?'selected':'' }} value="{{ url('/administrator/organization?view=25') }}">25</option>
            <option {{ $view==50?'selected':'' }} value="{{ url('/administrator/organization?view=50') }}">50</option>
            <option {{ $view==100?'selected':'' }} value="{{ url('/administrator/organization?view=100') }}">100</option>
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


        </section>
        <div class="copyright">
            BRUM-NS 2.0 | 2016 © Brum Info Tech.
        </div>


    </div>


@stop



         