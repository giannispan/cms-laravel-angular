<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Page;
use App\Repositories\PageRepository;
use App\Repositories\SubjectRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    /**
     * The subject repository instance.
     *
     * @var SubjectRepository
     */
    protected $subjects;

    /**
     * Create a new controller instance.
     *
     * @param  SubjectRepository  $subjects
     * @return void
     */
    public function __construct(SubjectRepository $subjects, PageRepository $pages)
    {
        //$this->middleware('auth');
        $this->middleware('jwt.auth');

        $this->subjects = $subjects;
        $this->pages = $pages;
    }



    /**
     * Display a list of all of the user's subjects.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request, Subject $subject)
    { 


        //Simple php version //////////////////////////////////////////////////////
    	//$model = Subject::find(1);
		

        /*return view('subjects.subjects', [
            'subjects' => $this->subjects->forUser($request->user()),
            'subjectsVisible' => $this->subjects->subjectsVisible($request->user())
           	
        ])->withModel($model);*/
    
        //AngularJS version ///////////////////////////////////////////////////////////
        return response()->json([
            'subjects' => $this->subjects->forUser($request->user()),
            'subjectsVisible' => $this->subjects->subjectsVisible($request->user()),
            'pages' => $this->pages->forUser($request->user())
            ], 200);
    }


    /**
     * Create a new subject.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        // Simple PHP version/////////////////////////////////////////////////////////
        /*$this->validate($request, [
            'name' => 'required|max:255',
            'visible' => 'required',
            'position' => 'required',
        ]);

       	$request->user()->subjects()->create([
            'name' => $request->name,
            'visible' => $request->visible,
            'position' => $request->position,
        ]);*/

        //AngularJS version///////////////////////////////////////////////////////////
       /* if(! $request->name or ! $request->position){
            return response()->json([
                'error' => [
                    'message' => 'Please Provide name, position and visibility'
                ]
            ], 422);
        }*/
        $subject = $request->user()->subjects()->create([
            'name' => $request->name,
            'visible' => $request->visible,
            'position' => $request->position,
        ]);
 
        return response()->json([
                'message' => 'Subject Created Succesfully',
                'subjects' => $this->transform($subject)
        ]);


       // return redirect('/subjects');
    }


    /**
     * Edit the given subject.
     *
     * @param  Request  $request
     * @param  Subject  $subject
     * @return Response
     */
    public function edit (Request $request, Subject $subject) {

    	/*return view('subjects.edit_subject', [
            'subjects' => $this->subjects->forUser($request->user()),
        ])->with('subject', $subject);*/


        //AngularJS version
        return response()->json([
            'subjects' => $this->subjects->forUser($request->user()),
            'subject' => $subject
            ], 200);

    }

        /**
     * Update the given subject.
     *
     * @param  Request  $request
     * @param  {Page}  $page
     * @return Response
     */
    public function update(Request $request, Subject $subject)
    {

        // Single PHP Version

    	/*$this->validate($request, [
            'name' => 'required|max:255',
            'visible' => 'required',
            'position' => 'required',
        ]);*/

       /* $subject->name = $request->name;
        $subject->visible = $request->visible;
        $subject->position = $request->position;
        $subject->save(); */

        //return redirect('/subjects');

        //AngularJS Version
        $subject->name = $request->name;
        $subject->visible = $request->visible;
        $subject->position = $request->position;
        $subject->save(); 

        return response()->json([
                'message' => 'Subject Updated Succesfully',
                'subject' => $this->transform($subject)
        ]);

    }

    /**
     * Destroy the given subject.
     *
     * @param  Request  $request
     * @param  Subject  $subject
     * @return Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        //$this->authorize('destroy', $subject);

        $subject->delete();

        //return redirect('/subjects');
    }

    public function getPagesForSubject($id) {
    	// $pages_for_subject = $this->subjects->forUser($request->user());
    	$pages = Page::where('subject_id', $id)->get();
    	//return $pages_for_subject;
    	 // return 'sss';
    	return view('subjects.subjects')->with('pages', $pages);
    	//return $pages_for_subject;
    }


    private function transformCollection($subjects){
        return array_map([$this, 'transform'], $subjects->toArray());
    }
 
    private function transform($subject){
        return [
                'id' => $subject['id'],
                'name' => $subject['name'],
                'visible' => $subject['visible'],
                'position' => $subject['position']
            ];
    }

}
