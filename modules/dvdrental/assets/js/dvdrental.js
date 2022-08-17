
(function($) {
    // Событие ставится при первоначальной загрузке и после обнавления pjax
    $('#films-table').on('click', handlerFilmsTable);
    $('#account-films-table').on('click', handlerAccountFilmsTable);
    $(document).on('pjax:end', function() {
        $('#films-table').on('click', handlerFilmsTable);
        $('#account-films-table').on('click', handlerAccountFilmsTable);
    });
    
    // Обработка событий таблицы списка фильмов каталога
    function handlerFilmsTable(e) {
        const $tag = $(e.target);
        if ($(e.target).hasClass('adding-film')) {
            addingFilm($tag);
        }
    }
    
    // Добавление фильма в аккаунт пользователя.
    // Изменяется иконка, контент не переписывается
    function addingFilm($tag) {
        $tag.LoadingOverlay("show");
        $.ajax({
            type: 'post',
            url: '/dvdrental/person/adding-film',
            data: {
                filmId: $tag.data('film_id')
            },
            success: function() {
                $tag.removeClass('adding-film');
                $tag.addClass('film-availability');
                $tag.prop('src', '/svg/check-circle.svg');
                $tag.LoadingOverlay("hide");
            }
        });
    }
    
    // Обработка событий таблицы списка фильмов аккаунта
    function handlerAccountFilmsTable(e) {
        const $tag = $(e.target);
        if ($tag.hasClass('removal-film')) {
            showRemovalFilm($tag);
        }
    }
    
    // В модальное окно подтверждения на удаление фильма добавляютя данные о фильме
    function showRemovalFilm($tag) {
        const $modal = $("#modal-film-deleting");
        
        $tag.LoadingOverlay("show");
        $modal.modal("show");
        $.ajax({
            type: 'post',
            url: '/dvdrental/person/data-film',
            data: {
                filmId: $tag.data('film_id')
            },
            success: function(data) {
                let film = JSON.parse(data);
                $('#deleted-film-name').html(film.title);
                $('#deleted-film-film_id').prop('value', film.filmId);
                $tag.LoadingOverlay("hide");
            }
        });
    }
    
})(jQuery);
