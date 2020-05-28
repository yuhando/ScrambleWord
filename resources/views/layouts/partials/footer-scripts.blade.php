<!-- jQuery v3.5.1 -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script>
    $(function() {
        var answer = '';
        var word_id = 0;
        var score = {{ auth()->user()->point ?? 0 }};
        var word_number = {{ auth()->user()->word_count ?? 0 }};

        function clear() {
            answer = '';
            $('.section-answer').empty();
            $('.section-question button').prop('disabled', false);
            $('.notification').hide();
        }

        function generateQuestion(word) {
            $('.section-question').empty();

            for (let i = 0; i < word.length; i++) {
                
                $('.section-question').append('<button type="button" class="btn btn-primary btn-lg btn-question"><span>' + word[i] + '</span></button>&nbsp;');
            }            
            
            $('.section-question').append('<button type="button" class="btn btn-danger btn-lg btn-clear"><span>Clear</span></button>');
        }

        function getWord() {
            $.ajax({
                method: 'GET',
                url: '{{ route('main.getWord') }}'
            }).done(function (data) {
                clear();
                generateQuestion(data.word);

                word_id = data.id;

                $('#category').html(data.category);

                $('.btn-question').bind('click',function() {
                    $(this).prop('disabled', true);
                    $('.section-answer').append('<button type="button" class="btn btn-outline-primary btn-lg" disabled><span>' + $(this).html() + '</span></button>&nbsp;');
                    answer += $(this).children().html();
                    
                    if (answer.length == data.word.length) {
                        $('.btn-clear').prop('disabled', true);
                        checkAnswer(word_id, answer);
                    }
                });

                $('.btn-clear').bind('click', function () {
                    clear();
                })
            });
        }

        function checkAnswer(word_id, data) {
            $.ajax({
                method: 'POST',
                url: '{{ route('main.postWord') }}',
                data: {
                    '_token' : $('meta[name=csrf-token]').attr('content'),
                    'word_id' : word_id,
                    'answer' : data
                }
            }).done(function (data) {
                if (data.status == 'correct') {
                    score += data.point;
                    $('#score').html(score);
                    word_number++;
                    $('#word_number').html(word_number);

                    $('.notification').removeClass('alert alert-danger').addClass('alert alert-success').html(data.status + '+' + data.point).fadeIn(1000).fadeOut(3000);
                    setTimeout(function () {
                        getWord();
                        $('.btn-clear').prop('disabled', false);
                    }, 3000);
                } else if (data.status == 'wrong') {
                    score += data.point;
                    $('#score').html(score);

                    $('.notification').removeClass('alert alert-success').addClass('alert alert-danger').html(data.status + ' ' + data.point).fadeIn(1000).fadeOut(3000);

                    $('.btn-clear').prop('disabled', false);
                }
            });
        }
        getWord();
    });
</script>