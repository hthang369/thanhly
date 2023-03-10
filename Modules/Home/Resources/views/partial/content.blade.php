@includeWhen(Request::is('/'), 'home::partial.main_content')
@includeWhen(!Request::is('/'), 'home::partial.full_content')