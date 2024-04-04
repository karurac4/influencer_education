<!-- 左側のメニューバー -->
<div class="col-md-3">
    <h3>学年一覧</h3>
    @foreach($grades as $key => $grade)
        @if($key < 6)
        <a href="#" class="btn btn-custom-lightblue grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @elseif($key < 9)
            <a href="#" class="btn btn-success grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @else
            <a href="#" class="btn btn-info grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @endif
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
$(document).on('click', '.grade-link', function(e) {
    e.preventDefault();
    var gradeId = $(this).data('grade-id');
    
    $.ajax({
        url: '/getCurriculums',
        method: 'GET',
        data: { grade_id: gradeId },
        success: function(response) {
            $('#curriculum-container').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch curriculums:', error);
        }
    });
});
</script>