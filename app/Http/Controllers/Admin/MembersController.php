<?php

namespace App\Http\Controllers\Admin;


use App\Member;
use Request;
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
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.members.create', compact('created_bies'));
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
        $member = Member::create($request->all());



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

        return view('admin.members.edit', compact('member', 'created_bies'));
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
        $member = Member::findOrFail($id);
        $member->update($request->all());



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
