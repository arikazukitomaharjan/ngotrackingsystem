@extends('administrator')
@section('content')


    <div class="site_body">
        <section class="site_list_view">

            <div class="section_hdr clearfix">
                <h1 class="site_page_title">All Users</h1>

                <span class="section_hdr_btns_wrp"><a href="{{ URL::route('createUser') }}" class="btn btn_green">Add new</a></span>

            </div>


            <div class="site_tabling">
                <table cellpadding="0" cellspacing="0">

                    <thead>

                    <tr>
                        <th>S.N.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>District</th>
                        <th>Last Login</th>
                        <th class="actions">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $i = 1;
                    ?>

                    @foreach($userList as $row)
                        <?php
                        $editLink = url('/administrator/user/edit/' . $row->id);
                        $deleteLink = url('/administrator/user/delete/' . $row->id);
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->username}}</td>
                            <td> {{ $row->email }}</td>
                            <td> {{ $row->role }}</td>
                            <td> {{ $row->wz_name }}  </td>
                            <td> {{ $row->last_login }}  </td>
                            <td>
                                <div class="action_icon"><i class="fa fa-cogs" aria-hidden="true"></i>

                                    <!--ActionBtns-->
                                    <span class="actions_wrapp">
                                        <a href="{{$editLink}}" class="fa fa-pencil-square-o" aria-hidden="true"></a>

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
                <?php
                $view = Request::get('view');
                if (!$view) {
                    $view = 10;
                }
                ?>
                <div class="grid_pagination">
                    <ul class="ftr_sort">
                        <li class="pull-left">
                            Showing <strong>{{ $userList->currentPage() }} </strong> of {{ $userList->lastPage() }}
                        </li>
                        <li>|</li>
                        <li><span>Show</span><span>
                                <select id="row-view-select">
                                       <option {{ $view==10?'selected':'' }} value="{{ url('/administrator/user?view=10') }}">10</option>
                <option {{ $view==25?'selected':'' }} value="{{ url('/administrator/user?view=25') }}">25</option>
                <option {{ $view==50?'selected':'' }} value="{{ url('/administrator/user?view=50') }}">50</option>
                <option {{ $view==100?'selected':'' }} value="{{ url('/administrator/user?view=100') }}">100</option> </select>
                        </span></li>
                    </ul>
                    <ul>
                        <li><a href="{!! $userList->previousPageUrl()!!}">Prev</a></li>
                        <li>{!!  str_replace('/?', '?', $userList->appends(['view' => $view ])->render()) !!}</li>
                        <li><a href="{!! $userList->nextPageUrl()!!}">Next</a></li>

                    </ul>
                </div>
            </div>
        </section>

    </div>



@stop



         