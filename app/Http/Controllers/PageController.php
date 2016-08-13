<?php

namespace App\Http\Controllers;

use App\Page;
use App\Subject;
use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use App\Repositories\SubjectRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class PageController extends Controller
{
    //
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $pages;

    /**
     * Create a new controller instance.
     *
     * @param  PageRepository  $pages
     * @return void
     */
    public function __construct(PageRepository $pages, SubjectRepository $subjects)
    {
        //$this->middleware('auth');
        $this->middleware('jwt.auth');

        $this->pages = $pages;
        $this->subjects = $subjects;
    }

    /**
     * Display a list of all of the user's pages.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        //Simple PHP Version
        //$model = Page::find(1);

        /*return view('pages.index', [
            'pages' => $this->pages->forUser($request->user()),
            'subjects' => $this->subjects->forUser($request->user()),
            'subjectsVisible' => $this->subjects->subjectsVisible($request->user())
        ])->withModel($model);*/

        
        //AngularJS Version
         return response()->json([
        'pages' => $this->pages->forUser($request->user()),
        'subjects' => $this->subjects->forUser($request->user()),
        'subjectsVisible' => $this->subjects->subjectsVisible($request->user())
        ], 200);
    }

    /**
     * Create a new page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        //Simple PHP Version
        /*$this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'subject_id' => 'required',
            'visible' =>'required'
        ]);*/

        /*$request->user()->pages()->create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'visible' => $request->visible,
            'content' => $request->content
        ]);

        return redirect('/pages');*/

        //AngularJS Version
        if(! $request->title or ! $request->subject_id){
            return response()->json([
                'error' => [
                    'message' => 'Please Provide name and subject'
                ]
            ], 422);
        }

        $page = $request->user()->pages()->create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'visible' => $request->visible,
            'content' => $request->content
        ]);

        return response()->json([
                'message' => 'Page Created Succesfully',
                'pages' => $this->transform($page)
        ]);
    }

    /**
     * Edit the given subject.
     *
     * @param  Request  $request
     * @param  Subject  $subject
     * @return Response
     */
    public function edit (Request $request, Page $page) {

        /*$model = Page::find(1);



    	return view('pages.edit_page', [
            'pages' => $this->pages->forUser($request->user()),
            'subjects' => $this->subjects->forUser($request->user()),
        ])->with('page', $page)->withModel($model);*/
    	//return view('subjects.edit_subject')->with('subject', $subject);


        //AngularJS Version
        //AngularJS version
        return response()->json([
            'subjects' => $this->subjects->forUser($request->user()),
            'pages' => $this->pages->forUser($request->user()),
            'page' => $page
            ], 200);

    }

        /**
     * Update the given subject.
     *
     * @param  Request  $request
     * @param  {Page}  $page
     * @return Response
     */
    public function update(Request $request, Page $page)
    {

    	//Simple PHP Version
        /*$this->validate($request, [
            'title' => 'required|max:255',
            'visible' => 'required',
            'subject_id' => 'required',
            'content' => 'required'
        ]);*/

    	/*$page->title = $request->title;
        $page->content = $request->content;
        $page->visible = $request->visible;
        $page->subject_id = $request->subject_id;
        $page->save(); 


        return redirect('/pages');*/

        //AngularJS Version
        $page->title = $request->title;
        $page->content = $request->content;
        $page->visible = $request->visible;
        $page->subject_id = $request->subject_id;
        $page->save(); 

        return response()->json([
                'message' => 'Page Updated Succesfully',
                'page' => $this->transform($page)
        ]);

    }

    /**
     * Destroy the given page.
     *
     * @param  Request  $request
     * @param  Page  $page
     * @return Response
     */
    public function destroy(Request $request, Page $page)
    {
        //$this->authorize('destroy', $page);

        $page->delete();

        //return redirect('/pages');
    }

    public function getSubject() {

    }


    private function transformCollection($pages){
        return array_map([$this, 'transform'], $pages->toArray());
    }
 
    private function transform($page){
        return [
                'id' => $page['id'],
                'title' => $page['title'],
                'subject_id' => $page['subject_id'],
                'visible' => $page['visible'],
                'content' => $page['content']
            ];
    }
}
