
@extends('inc.layout')

@section('content')

<main class="m-5 p-5">
     <div class="text-center pb-3 m-3 mt-0 pt-0">
            <a   class=" h1 font-weight-bold"> DevProx Assessment 
            </a>
            <br>
            <p class="h3"> Please Click any of the two Buttons bellow.</p>
        </div>
    <section class="row ">
        <div class="col-md-6 px-5">
            <a href="{{ url('/test1') }}" class="card border-primary shadow-2xl rounded">
              <div class="card-body text-center">
                <p class="card-title h1 font-weight-bold">Test 1</p>
                <p class="card-text h3 font-weight-bold">Click here to go to assessment 1</p>
                <i class="small text-muted">[Creating users and validating input fields]</i>
              </div>
            </a>
        </div>

        {{--  --}}

         <div class="col-md-6 px-5">
            <a href="{{ url('/test2') }}" class="card border-primary shadow-2xl rounded">
               <div class="card-body text-center">
                <p class="card-title h1 font-weight-bold">Test 2</p>
                <p class="card-text h3 font-weight-bold">Click here to go to assessment 1</p>
                <i class="small text-muted">[File handling and Data Structures]</i>
              </div>
            </a>
        </div>
    </section>
</main>
<script>
     
</script>
@endsection
