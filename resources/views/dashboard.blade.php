@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/homeselector.js') }}" defer></script>
@endsection
@section('content')
    <div class="container py-2" id="dashboard">
        <div class="row justify-content-center">
            <div class="col text-center">
                <p class="h3 font-weight-bold">The latest beer</p>

                <div class="d-flex flex-row ">
                    <x-product-vertical :product=$latest[0] class="d-block"/>
                    <x-product-vertical :product=$latest[1] class="d-none d-md-block"/>
                    <x-product-vertical :product=$latest[2] class="d-none d-lg-block"/>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row justify-content-center">
            <div id="categoryHomepage" class="col justify-content-center text-center">
                <p class="h3 font-weight-bold">All our Beer</p>
                <small>Filter by category</small>
                <div id="categories" class="nav-scroller d-flex justify-content-center m-1">
                    <nav class="nav nav-pills nav-justified bg-dark rounded shadow-sm">
                        @foreach($categories as $category=>$products)
                            @if($loop->first)
                                <a class="nav-link selectcategory active" href="#">All</a>
                            @endif
                            <a class="nav-link selectcategory" href="#">{{$category}}</a>
                        @endforeach
                    </nav>
                </div>

                <div class="container mt-2">
                    @foreach($categories as $category=>$products)
                        <div class="filterDiv {{$category}}">
                            <h4 class="d-inline text-uppercase bg-warning">-<strong>{{$category}}</strong>-</h4>
                            <div class="row justify-content-center ">

                                @foreach($products as $product)
                                    @if($product->is_available)

                                        <x-product-square :product=$product />

                                    @endif
                                @endforeach
                            </div>
                            <hr/>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>
@endsection

{{--

<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <button class="btn" onclick="filterSelection('cars')"> Cars</button>
  <button class="btn" onclick="filterSelection('animals')"> Animals</button>
  <button class="btn" onclick="filterSelection('fruits')"> Fruits</button>
  <button class="btn" onclick="filterSelection('colors')"> Colors</button>
</div>

<div class="container">
  <div class="filterDiv cars">BMW</div>
  <div class="filterDiv colors fruits">Orange</div>
  <div class="filterDiv cars">Volvo</div>
  <div class="filterDiv colors">Red</div>
</div>

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

--}}
