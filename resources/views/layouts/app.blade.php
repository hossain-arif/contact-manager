<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Item - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <form action="{{ route('contacts.index') }}" class="navbar-form navbar-right">
                <div class="input-group">
                    <input type="text" name="term" value="{{ Request::get('term') }}" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search">Search</i>
                        </button>
                    </span>
                </div>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('contacts.create') }}" class="btn btn-success">Add new contact</a>

                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">
			<?php $selected_group = Request::get( 'group_id' ) ?>
            <div class="list-group">
                <a href="{{ route('contacts.index') }}"
                   class="list-group-item {{ empty($selected_group) ? 'active' : '' }}">All contacts
                    ({{ App\Contact::count() }})</a>
                @foreach(App\Group::all() as $group)
                    <a href="{{ route('contacts.index',['group_id' => $group->id]) }}"
                       class="list-group-item {{ $selected_group == $group->id ? 'active' : '' }}">{{ $group->name }}
                        ({{ $group->contacts()->count() }})</a>
                @endforeach
            </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @yield('content')
        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("input[name=term]").autocomplete({
            source: "{{ route("contacts.autocomplete") }}",
            minLength: 3,
            select: function(event, ui){
                $(this).val(ui.item.value);
            }
        })
    })
</script>

@yield('scripts')

</body>

</html>
