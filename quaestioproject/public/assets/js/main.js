//
// UIkit.util.on('modalLogin ', 'click', function (e) {
//     e.preventDefault();
//     console.log(1);
//     e.target.blur();
//     UIkit.modal.alert('UIkit alert!').then(function () {
//         console.log('Alert closed.')
//     });
// });
//
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('body').bind("ajaxSend", function (elm, xhr, s) {
        if (s.type == "POST") {
            xhr.setRequestHeader('X-CSRF-Token', getCSRFTokenValue());
        }
    })

    $('.emptyLink').click(function () {
        UIkit.modal('#modalLogin').show();
    })
    $('.reportLink').click(function (e) {
        e.preventDefault();
        // UIkit.modal('#modalReport').show();
    })

    /******************  Show one question from notifications  *************************/
    $('.viewLink').click(function (e) {
        e.preventDefault();
        let answer_id = $(this).data('id');
        getNotificationData(answer_id);
    })

    /****************** Search users ****************************/
    $('#search').on('keyup focus', function() {
        let key = $(this).val();
        key = key.trim();

        if (key.length != 0)
            getSearchedUsers(key);
        else
            getSearchedUsers(null);
    })
    $('#search').blur(function () {
        getSearchedUsers(null);
    })

    /*********************** Delete answer **************************/
    $('.deleteLink').click(function(e){
        e.preventDefault();
        let answer_id = $(this).data('id');
        deleteRequest(answer_id);
    })

})
function getNotificationData(answer_id){
    $.ajax({
        method : 'get',
        url : 'notifications/'+answer_id,
        // data : {'date' : da},
        dataType : 'json',
        // accepts:'application/json',
        // contentType:'application/json',
        success : function(package){
            // console.log(package);
            previewNotification(package);
        },
        error : function(request, error){
            console.log(arguments);
            console.log(" Can't do because: " + error);
        }
    })
}

function previewNotification(package){
    let data = package;
    let html='';

    html += `
        <article class="uk-comment questionAnswer questionAnswerWraper">
            <header class="uk-comment-header questionHeader">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="storage/products/${data.image}" alt="${data.userTo}">
                    </div>
                    <div class="uk-width-expand">
                        <p class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="/user/${data.userTo_id}"> ${data.userTo} </a></p>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body answer uk-margin-remove-bottom">
                <p class="question"> ${data.question} &nbsp; <a href="/user/${data.userFrom_id}" class="userFrom"> (You) </a></p>
                <p class="uk-margin-remove-top"> ${data.answer} </p>
            </div>
        </article>
        `;

    $('#notification').html(html);
    UIkit.modal('#modalNotification').show();
}

function getSearchedUsers(key){
    $.ajax({
        method : 'get',
        url : 'getUsers/'+key,
        // data : {'key' : key},
        dataType : 'json',
        // accepts:'application/json',
        // contentType:'application/json',
        success : function(package){
            previewSearchedUsers(package);
        },
        error : function(request, error){
            console.log(arguments);
            console.log(" Can't do because: " + error);
        }
    })
}

function previewSearchedUsers(package){
    let data = package;
    let html='';

    for(let one in data) {
        html += `
            <a class="searchColor" href="/user/${data[one].id}">
                <div class="oneSearched">
                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-comment-avatar" src="storage/products/${data[one].image}" alt="${data[one].username}">
                        </div>
                        <div class="uk-width-expand">
                            <p class="uk-margin-remove"> ${data[one].username} </p>
                        </div>
                    </div>
                </div>
            </a>
        `;
    }
    $('#searchResult').html(html);
}

function deleteRequest(answer_id){
    $.ajax({
        method : 'delete',
        url : '/deleteAnswer/'+answer_id,
        // data : {'key' : key},
        dataType : 'json',
        // accepts:'application/json',
        // contentType:'application/json',
        success : function(){
            location.reload();
        },
        error : function(request, error){
            console.log(arguments);
            console.log(" Can't do because: " + error);
        }
    })
}

function changeRoles(role_id, user_id){
    $.ajax({
        method : 'put',
        url : '/changeRole/'+role_id+'/'+user_id,
        // data : {'key' : key},
        dataType : 'json',
        // accepts:'application/json',
        // contentType:'application/json',
        success : function(){
            location.reload();
        },
        error : function(request, error){
            console.log(arguments);
            console.log(" Can't do because: " + error);
        }
    })
}
