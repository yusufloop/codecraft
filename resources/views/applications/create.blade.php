<form action="{{ route('applications.store', $job->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="job_id" value="{{ $job->id }}">

    <div>
        <label for="resume">Resume</label>
        <input type="file" name="resume" required>
    </div>

    <div>
        <label for="cover_letter">Cover Letter</label>
        <textarea name="cover_letter" rows="4"></textarea>
    </div>

    <div>
        <label for="skills">Skills</label>
        <input type="text" name="skills[]" placeholder="Enter a skill">
        <input type="text" name="skills[]" placeholder="Enter another skill">
        <!-- Add more fields dynamically if needed -->
    </div>

    <button type="submit">Submit Application</button>
</form>
