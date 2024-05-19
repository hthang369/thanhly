@includeWhen(Request::is('/'), module_view('partial.main_content'))
@includeWhen(!Request::is('/'), module_view('partial.full_content'))
