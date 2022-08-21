<?php

namespace App\Http\Controllers\Admin;

use App\Test;
use App\Member;
use Request;
use App\TypeOfSelectedTest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMembersRequest;
use App\Http\Requests\Admin\UpdateMembersRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request as NRequest;


class MembersController extends Controller
{
    /**
     * Display a listing of Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('member_access')) {
            return abort(401);
        }
        if ($filterBy = Request::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Member.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Member.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('member_delete')) {
                return abort(401);
            }
            $members = Member::onlyTrashed()->get();
        } else {
            $members = Member::all();
        }

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating new member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('member_create')) {
            return abort(401);
        }
        
        $tests = \App\Test::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.members.create', compact('created_bies', 'tests'));
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \App\Http\Requests\StoreMembersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembersRequest $request)
    {
        if (! Gate::allows('member_create')) {
            return abort(401);
        }
        // $input = $request->all(); 
        // $type_avail = $input['type_avail'];
        // $input['type_avail'] = implode(',','$type_avail');

        //  dd($request->all());
        $data = $request->validated();
        //$data['field_name'];
        // dd($data);
        $member = Member::create($data); //since pareho naman mga fields pwede ganto
        // dd($request->test_id);
        if (isset($request->test_id))
        {
            foreach($request->test_id as $test_id){
                $member->typeOfTest()->create([
                    'member_id' => $member->id,
                    'test_id' => $test_id
                ]);

            }
        }
        

        // $test = $member['test'];
        // $member['test']= implode(',',$test);
        

        return redirect()->route('admin.members.index');
    }


    /**
     * Show the form for editing member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('member_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $member = member::findOrFail($id);

        $member->load('typeOfTest');

        $member_tests = [];
        foreach ($member->typeOfTest as $test) {
            $member_tests[] = $test->test_id;
        }

        $tests = Test::orderBy('name', 'asc')->get();

        return view('admin.members.edit', compact('member', 'created_bies', 'tests', 'member_tests'));
    }

    /**
     * Update member in storage.
     *
     * @param  \App\Http\Requests\UpdateMembersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembersRequest $request, $id)
    {
        if (! Gate::allows('member_edit')) {
            return abort(401);
        }

        /***
         * 1. update mo member table
         * 2. delete mo yung data sa type of selected where member  id is yung id 
         * 3. insert mo ulit yung bgong updated na selected from dropdown, minsan mas madami kasi sini select or nababawas
         */
        $data = $request->validated();

        $member = Member::findOrFail($id);
        $member->update($data);

        /***
         * 1. check kong walang laman yung dropdown, kong wala delete lang yung laman ng type of selected. no need na mag insert
         * 2. otherwise gawin mo itong nasa baba
         * ito para matapos naa
         * 
         */
        if (!isset($request->test_id))
        {
            TypeOfSelectedTest::where('member_id', $id)->delete();
        }

        if (isset($request->test_id)) //since di na tayo gumamit ng count() wala ng > 0
        {
            
            //delete all records from typeofselected table
            TypeOfSelectedTest::where('member_id', $id)->delete();

            foreach($request->test_id as $test_id){
                $member->typeOfTest()->create([
                    'member_id' => $member->id,
                    'test_id' => $test_id
                ]);

            }
        }



        return redirect()->route('admin.members.index');
    }


    /**
     * Remove member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.members.index');
    }

    /**
     * Delete all selected member at once.
     *
     * @param Request $request
     */
    public function massDestroy(NRequest $request)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Member::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->restore();

        return redirect()->route('admin.members.index');
    }

    /**
     * Permanently delete member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('member_delete')) {
            return abort(401);
        }
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->forceDelete();

        return redirect()->route('admin.members.index');
    }
}
