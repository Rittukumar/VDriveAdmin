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

			return $this->setStatusCode(500)->respondWithError($errorMessage);

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

			return $this->setStatusCode(500)->respondWithError($errorMessage);
		}

	}


	public function saveCategory()
	{
		try{

			$all = Input::all();

			$categoryId   = $all['id'];
			$categoryName = $all['category_name'];
			$sectionId    = $all['section_id'];

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

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}


	public function saveSubCategory()
	{

		try{

			$all = Input::all();

			$subcategoryId   = $all['id'];
			$subcategoryName = $all['subcategory_name'];
			$categoryId      = $all['category_id'];

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

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}


	public function deleteCategory($categoryId)
	{

		try{

			$delete = Category::where('id', $categoryId)->delete();

			$successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}


	public function deleteSubCategory($subcategoryId)
	{

		try{

			$delete = SubCategory::where('id', $subcategoryId)->delete();

			$successResponse = [
                 'status' => true
             ];

            return $this->setStatusCode(200)->respond($successResponse);

		}catch(Exception $e){

			return $this->setStatusCode(500)->respondWithError($errorMessage);

		}

	}






}


?>