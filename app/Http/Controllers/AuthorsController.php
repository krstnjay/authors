<?php

    namespace App\Http\Controllers;

    use App\Models\Authors;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;
    use Illuminate\Http\Request;
    use DB;

    Class AuthorsController extends Controller {

        use ApiResponser;

        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }
        
        public function getAuthors(){
            $authors = Authors::all();

            return $this->successResponse($authors);
        }

        /**
         * Return the list of authors
         * @return Illuminate\Http\Response
         */

        public function index(){
            $authors = Authors::all();
            return $this->successResponse($authors);
        }


        public function add(Request $request){
            $rules = [
                'id' => 'required|numeric|min:1|not_in:0',
                'fullname' => 'required|min:1|not_in:0',
                'birthday' => 'required|min:1|not_in:0',
                'gender' => 'required|in:Male,Female',
            ];

            $this->validate($request, $rules);
            $authors = Authors::create($request->all());
            return $this->successResponse($authors, Response::HTTP_CREATED);
        }

        /**
        * Obtains and show one author
        * @return Illuminate\Http\Response
        */
        
        public function show($id){

            $authors = Authors::findOrFail($id);
            return $this->successResponse($authors);
        
        }

        /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
        public function update(Request $request, $id){
            $rules = [
                'id' => 'required|numeric|min:1|not_in:0',
                'fullname' => 'required|min:1|not_in:0',
                'birthday' => 'required|min:1|not_in:0',
                'gender' => 'required|in:Male,Female',
            ];

            $this->validate($request, $rules);
            $authors = Authors::findOrFail($id);

            $authors->fill($request->all());
            // if no changes happen
            if ($authors->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $authors->save();
            return $this->successResponse($authors);
        }

        /**
         * Remove an existing author
         * @return Illuminate\Http\Response
         */

         public function delete($id){
             $author = Authors::findOrFail($id);
             $author->delete();
             return $this->errorResponse('Author ID Does Not Exists', Response::HTTP_NOT_FOUND);
         }

}

?>