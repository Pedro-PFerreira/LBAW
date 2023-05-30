@extends('layouts.app')
<?php $counter = 0?>
@section('content')
    <div class="info-container" id="all-categories-container">
        <div id="first-categories" class ="categories-container">
            @foreach($categoriesFirst as $category)
                <div class="category-ref"> 
                    <a href=<?php echo route('categories.articles', $category->id)?>
                        <button class="category-button"> <?php echo $category->categoryname . '<br>';?>
                    </a>
                </div>
            @endforeach
        </div>
        <div class ="categories-container">
            @foreach($categoriesSecond as $category)
                <div class="category-ref">
                    <a href=<?php echo route('categories.articles', $category->id)?>
                        <button class="category-button" > <?php echo $category->categoryname . '<br>';?>
                    </a>
                </div>
            @endforeach
        </div> 
    </div>
@endsection