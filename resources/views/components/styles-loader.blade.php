@foreach($styles as $style)
    <link rel="stylesheet" type="text/css" href="{{asset("{$style}.css")}}">
    @endforeach
