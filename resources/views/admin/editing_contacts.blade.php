@extends('admin.layout')
@section('content')
<div class="content_editing">
    <form method="post" action="/admin/contents/contacts">
        <textarea name="content" rows="20" cols="70">{{ $page['content'] }}</textarea><br>
        <input type="submit" value="Сохранить">
    </form>
</div>
@endsection