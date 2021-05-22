<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Jobs\SendQueueEmail;
use App\Models\Coupon;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Validator;

class Admin_NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::any(['view_order', 'view_product'])) {
            abort(403);
        }
        $emails = Newsletter::get();

        return view('admin.newsletter.list', [
            'emails'=>$emails,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::any(['create_order', 'create_product'])) {
            abort(403);
        }
        return view('admin.newsletter.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::any(['create_order', 'create_product'])) {
            abort(403);
        }
        $request->validate([
            'email' => 'required|unique:newsletter|max:255'
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();
        return redirect()->route("admin.newsletter.index")->with('success', "Added Newletter  - {$newsletter->email} Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        if (!Gate::any(['update_order', 'update_product'])) {
            abort(403);
        }
        return view('admin.newsletter.edit' , [
            'newsletter' => $newsletter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        if (!Gate::any(['update_order', 'update_product'])) {
            abort(403);
        }
        $request->validate([
            'email' => 'required|unique:newsletter|max:255'
        ]);
        $newsletter->email = $request->email;
        $newsletter->save();
        return redirect()->route("admin.newsletter.index")->with('success', "Updated Email - {$newsletter->email} Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        if (!Gate::any(['delete_order', 'delete_product'])) {
            abort(403);
        } 
        try {
            // dd($request->checkboxes);
            $msg = 'Deleted email subscription : '.$newsletter->email.'';
            $newsletter->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.newsletter.index");
    }

    public function delete(Request $request)
    {
        if (!Gate::any(['delete_order', 'delete_product'])) {
            abort(403);
        }
        if($request->checkboxes == null) {
            request()->session()->put('error', 'No Emails Selected');
            return redirect()->route("admin.newsletter.index");
        } 
        try {
            $emails = $request->checkboxes;
            // dd($emails);
            foreach ($emails as $email) {
                $newsletter = Newsletter::where('email', $email)->first();
                $newsletter->delete();
            }
            $msg = 'Deleted Emails Successfully';
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.newsletter.index");
    }

    public function list_send_mail()
    {
        if (!Gate::any(['view_order', 'view_product'])) {
            abort(403);
        }
        $emails = Newsletter::get();
        $coupons = Coupon::get();

        return view('admin.newsletter.send', [
            'emails' => $emails,
            'coupons' => $coupons
            ]);
    }

    public function send_mail(Request $request)
    {
        // dd($request->checkboxes);
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json($validator->errors()->all() , 400);
        }
        else {
            try {
                $details = [
                    'subject' => $request->subject,
                    'body' => $request->body,
                    'checkboxes' => $request->checkboxes,
                ];

                $job = (new SendQueueEmail($details))
            	->delay(now()->addSeconds(2)); 
                 dispatch($job);
            } catch (Exception $e) {
                return response()->json([$e->getMessage()], 400);
            }
        }
    }
}
