<?php 


class MasterController extends AppController
{


	public function getAllCategories()
	{

		try{

			$categories = Category::all();

			$successResponse = [
                 'status' => true,
                 'categories' => $categories,
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}

	}


	public function getsubCategoryById($categoryId)
	{

		try{

			$subcategories = SubCategory::where('category_id', '=', $categoryId)->get();

			$successResponse = [
                 'status' => true,
                 'subcategories' => $subcategories,
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);
		}

	}


	public function getEvezownSections()
	{
		try{

			$evezownSections =  EvezownSection::all();

			$successResponse = [
                 'status' => true,
                 'evezownSections' => $evezownSections,
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}
	}


	public function saveCategory()
	{
		try{

			$all = Input::all();
			$input_array  = $all['data'];
			$selectedCategory = $input_array['Categories'];

			$categoryId   = isset($selectedCategory['id'])? $selectedCategory['id'] : '';
			$categoryName = $selectedCategory['category_name'];
			$sectionId    = $selectedCategory['section_id'];

			if(empty($categoryId))
		    {
		       $category = new \Category();
		    }
		    else
		    {
		       $category = \Category::find($categoryId);
		    }          
      
		    $category -> category_name = $categoryName;
		    $category -> section_id    = $sectionId;

		    $category -> save();

		    $successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}

	}


	public function saveSubCategory()
	{

		try{

			$all = Input::all();
			$input_array  = $all['data'];
			$selectedSubCategory = $input_array['SubCategories'];

			$subcategoryId   = isset($selectedSubCategory['id'])? $selectedSubCategory['id'] : '';
			$subcategoryName = $selectedSubCategory['subcategory_name'];
			$categoryId      = $selectedSubCategory['category_id'];

			if(empty($subcategoryId))
		    {
		       $subcategory = new \SubCategory();
		    }
		    else
		    {
		       $subcategory = SubCategory::find($subcategoryId);
		    }                       
      
		    $subcategory -> subcategory_name = $subcategoryName;
		    $subcategory -> category_id      = $categoryId;

		    $subcategory -> save();

		    $successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}

	}


	public function deleteCategory($adminId, $categoryId)
	{

		try{

			$delete = Category::where('id', $categoryId)->delete();

			$successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}

	}


	public function deleteSubCategory($adminId, $subcategoryId)
	{

		try{

			$delete = SubCategory::where('id', $subcategoryId)->delete();

			$successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($e);

		}

	}






}


?>