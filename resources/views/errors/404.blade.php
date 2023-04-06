@extends("layouts.app")



@section('title' , 'Create')

@section('style')

@endsection


@section("header","Orders")


@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">404 page not found</a></li>

@endsection


@section("content")

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href="{{route("index")}}">return to home page</a>.
                </p>

            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>


@endsection
