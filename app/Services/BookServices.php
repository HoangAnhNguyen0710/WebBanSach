<?php

namespace App\Services;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PublisherRepository;
use Illuminate\Http\Request;
use League\Csv\Reader;

class BookServices {

// protected ArticleRepository $articleRepository;


public function __construct()
{
    $this->bookRepository = app(BookRepository::class);
    $this->publisherRepository = app(PublisherRepository::class);
    $this->categoryRepository = app(CategoryRepository::class);
}
public function isAValidRecord($record, $category_list, $publisher_list) {
    $errorRecord = [];

    if(empty($record['name'])) {
            $errorRecord['errorMSG'] = 'missing book name!\n';
            return $errorRecord;
        }
    if(mb_strlen($record['name'] > 30)) {
            $errorRecord['errorMSG'] = 'invalid book name (length > 30)!\n';
            return $errorRecord;
        }
    if(empty($record['author_name'])) {
            $errorRecord['errorMSG'] = 'missing book author_name!\n';
            return $errorRecord;
        }
    if(mb_strlen($record['author_name'] > 30)) {
            $errorRecord['errorMSG'] = 'invalid book author_name (length > 30)!\n';
            return $errorRecord;
        }
    if(empty($record['type'])) {
            $errorRecord['errorMSG'] = 'missing book type!\n';
            return $errorRecord;
        }
    if(mb_strlen($record['type'] > 30)) {
            $errorRecord['errorMSG'] = 'invalid book type (length > 30)!\n';
            return $errorRecord;
        }
    if(empty($record['description'])) {
            $errorRecord['errorMSG'] = 'missing book description!\n';
            return $errorRecord;
        }
    if(mb_strlen($record['description'] > 1024)) {
            $errorRecord['errorMSG'] = 'invalid book description (length > 1024)!\n';
            return $errorRecord;
        }
    if(empty($record['pages'])) {
            $errorRecord['errorMSG'] = 'missing book page num!\n';
            return $errorRecord;
        }
    if((int)($record['pages']) <= 0) {
            $errorRecord['errorMSG'] = 'invalid book page num type!\n';
            return $errorRecord;
        }
    if(empty($record['publisher_id'])) {
            $errorRecord['errorMSG'] = 'missing publisher id!\n';
            return $errorRecord;
        }
    if(empty($record['category_id'])) {
            $errorRecord['errorMSG'] = 'missing category id!\n';
            return $errorRecord;
        }
    if(!in_array(['id'=> $record['publisher_id']], $publisher_list)) {
        $errorRecord['errorMSG'] = 'publisher id is not exist!\n';
        return $errorRecord;
        }
    if(!in_array(['id'=> $record['category_id']], $category_list)) {
        $errorRecord['errorMSG'] = 'category id is not exist!\n';
        return $errorRecord;
        }
    if(!empty($record['price'] && $record['price'] < 0)) {
        $errorRecord['errorMSG'] = 'invalid book price!\n';
        return $errorRecord;
    }
    if(!empty($record['discount_price'] && !empty($record['price']) && $record['discount_price'] < 0)) {
        $errorRecord['errorMSG'] = 'invalid book price discount!\n';
        return $errorRecord;
    }
    if(!empty($record['discount_price'] && !empty($record['price']) && $record['discount_price'] >  $record['price'])) {
        $errorRecord['errorMSG'] = 'invalid book price discount! (price discount cannot bigger than price)\n';
        return $errorRecord;
    }
    if(!empty($record['in_stock']) && (int)($record['in_stock']) < 0) {
        $errorRecord['errorMSG'] = 'invalid book in_stock number!\n';
        return $errorRecord;
    }
    if(!empty($record['sold']) && (int)($record['sold']) < 0) {
        $errorRecord['errorMSG'] = 'invalid book sold number!\n';
        return $errorRecord;
    }
    return true;
}
public function store(Request $request) {
    $category_list = $this->publisherRepository->getAll();
    $publisher_list = $this->categoryRepository->getAll();
    if($request->file('fileUpload')) {
        $fileData = Reader::createFromPath($request->file('fileUpload')->getRealPath(), 'r');
        $fileData->setHeaderOffset(0);
        $fileRecords = $fileData->getRecords();
        $dataList = $this->getDataFromCSV($fileRecords);
        $offset = 0;
        foreach($dataList as $record) {
            $offset ++;
            $checked = $this->isAValidRecord($record, $category_list, $publisher_list);
            if($checked !== true) {
                $errMSG = "line " . $offset . ": " . $checked['errorMSG'];
                return $errMSG;
            }
          
        }
      
        return $this->bookRepository->store($dataList);
    }
    else {
    $requestData = array_merge($request->only([
        'id',
        'name',
        'author_name',
        'pages',
        'in_stock',
        'sold',
        'number_of_copies',
        'type',
        'language',
        'description',
        'display',
        'price',
        'discount_price',
        'publisher_id',
        'category_id'
    ]), []);
    $checked = $this->isAValidRecord($requestData,  $category_list, $publisher_list);
        if($checked !== true) {
                $errMSG = $checked['errorMSG'];
                return $errMSG;
        }
        else
        return $this->bookRepository->store([$requestData]);
    }
}

public function getDataFromCSV($fileRecords)
{
    $dataList = [];
    $offset = 0;
    foreach ($fileRecords as $Record) {
        $dataList[$offset] = $Record;
        $offset++;
    }
    return $dataList;
}

public function getOneBook($book_id) {
    return $this->bookRepository->getOne($book_id);
}
}
?>