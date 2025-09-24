<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="/assets/css/edit.css">
    </head>
<body>
    <div class="container">
        <h1 style="margin-bottom: 1rem;">Edit Task</h1>
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}" required minlength="3" />
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    @foreach (['pending' => 'Pending', 'in-progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $task->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="due_date">Due Date</label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date) }}" />
                @error('due_date')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; gap:.5rem;">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn" href="{{ route('tasks.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>


