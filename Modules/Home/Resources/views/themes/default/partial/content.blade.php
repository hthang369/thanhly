@includeWhen(Request::is('/'), vnnit_module_view('home', 'partial.main_content'))
@includeWhen(!Request::is('/'), vnnit_module_view('home', 'partial.full_content'))
