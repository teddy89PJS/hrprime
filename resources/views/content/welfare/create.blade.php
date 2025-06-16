@extends('layouts.app')

@section('title', 'Create Award')


@section('content')
<div class="container">
    <h2>Create a New Award Nomination</h2>
    <form method="POST" action="/awards">
        @csrf
        <div>
            <label>Award Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description" required></textarea>
        </div>
        <div id="criteria-wrapper">
            <label>Criteria (optional):</label>
            <div>
                <input type="text" name="criteria[]">
            </div>
        </div>
        <button type="button" onclick="addCriteria()">Add Another Criteria</button>
        <button type="submit">Next</button>
    </form>
</div>

<script>
function addCriteria() {
    const div = document.createElement('div');
    div.innerHTML = '<input type="text" name="criteria[]">';
    document.getElementById('criteria-wrapper').appendChild(div);
}
</script>
@endsection

