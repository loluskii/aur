<?php

namespace App\Http\Controllers\Admin;

use App\Models\Newsletter;
use App\Models\MailContent;
use App\Jobs\SendNewsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Newsletter::all();
    return view('admin.newsletter.index', compact('subscribers'));
    }
    
    public function showNewsletters(){
        $newsletters = MailContent::all();
        return view('admin.newsletter.all', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletter.create');
    }
    
    public function store(Request $request){
        try {
            $subject = $request->subject;
            $content = $request->content;
            
            $newsletter = new MailContent;
            $newsletter->subject = $subject;
            $detail = $content;
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $detail = $dom->savehtml();
            $newsletter->content = $detail;
            $newsletter->save();
            try {
                SendNewsletter::dispatch($detail)->delay(now()->addSeconds(2));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } catch (\Exception $e) {
            return back()->with('error','an error occured');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubscriber(Request $request)
    {
        // dd($request->all());
        try{
            $newsletter =  new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->save();
            return back()->with('success', 'Subscribed!');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
