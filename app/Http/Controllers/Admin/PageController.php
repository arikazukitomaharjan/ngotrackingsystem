<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin\Page;
use Redirect;
use Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pageList = Page::get();
        return view('admin.page.page-list' , compact( 'pageList' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.page.create-page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $pageslug = preg_replace('/[^a-zA-Z0-9]+/', '-', Request::get('title'));
        $page = new Page;
        $page->title   = Request::get('title');
        $page->slug    = strtolower($pageslug);
        $page->content = Request::get('content');
        $page->save();
        return Redirect::to('/admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id )
    {
        $page = Page::where( 'id' , $id )->first();
        return view('admin.page.edit-page' , compact( 'page' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $page = page::find( $id );
        $page->title = Request::get('title');
        $page->content = Request::get('content');
        $page->save();
        return Redirect::to('/admin/pages/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
       Page::where( 'id' , $id)->delete();
       return Redirect::to('/admin/pages');
    }
}
