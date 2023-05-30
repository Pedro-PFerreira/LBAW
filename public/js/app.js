let baseUrl = window.location.origin;

function addEventListeners() {
  let itemCheckers = document.querySelectorAll('article.card li.item input[type=checkbox]');
  [].forEach.call(itemCheckers, function(checker) {
    checker.addEventListener('change', sendItemUpdateRequest);
  });

  /*
  let commentCreator = document.querySelector('div.info-container');
  if(commentCreator != null)
    commentCreator.addEventListener('click', sendCreateCommentRequest);*/

  let itemCreators = document.querySelectorAll('article.card form.new_item');
  [].forEach.call(itemCreators, function(creator) {
    creator.addEventListener('submit', sendCreateItemRequest);
  });

  let itemDeleters = document.querySelectorAll('article.card li a.delete');
  [].forEach.call(itemDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteItemRequest);
  });

  let cardDeleters = document.querySelectorAll('article.card header a.delete');
  [].forEach.call(cardDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteCardRequest);
  });

  let cardCreator = document.querySelector('article.card form.new_card');
  if (cardCreator != null)
    cardCreator.addEventListener('submit', sendCreateCardRequest);

  let searchRunner = document.getElementById('header-search');
  if(searchRunner != null){
    searchRunner.addEventListener('keyup', (e) => {
      let fulltext = document.getElementById('full-text');
      if(e.key == 'Enter'){
          fullTextSearch(searchRunner.value);
      }
      e.preventDefault();
    }, true);
  }

  let filterOptions = document.getElementsByClassName("filter-option");
  if(filterOptions != null){
    for(const filterOption of filterOptions){
      filterOption.addEventListener('click', ()=>{
        let selectedType;
        if(filterOption.classList.contains("type-option")){
          selectedType = document.getElementById("selected-type");
        }
        else if(filterOption.classList.contains("sort-option")){
          selectedType = document.getElementById("selected-sort");
        }
        else if(filterOption.classList.contains("order-option")){
          selectedType = document.getElementById("selected-order");
        }
        else if(filterOption.classList.contains("search-option")){
          selectedType = document.getElementById("selected-search");
        }
        else{
          console.log("Error: invalid filter option\n")
          return;
        }
        if(selectedType.innerText !== filterOption.innerText){
          processNewFilterOption(selectedType, filterOption);
        }
      })
    }
  }

  let applyFilters = document.getElementById("search-apply-button-container");
  if(applyFilters != null){
    applyFilters.addEventListener('click', ()=>{
      let searchBar = document.getElementById("page-search");
        let target = searchBar.value;
        if(target == ""){
          console.log("Error: nothing to search");
        }else{
          searchWithFilters(target);
        }
    })
  }

  let filteredSearch = document.getElementById('page-search');
  if(filteredSearch != null){
    filteredSearch.addEventListener('keyup', (e) => {
      if(e.key == 'Enter'){
          searchWithFilters(filteredSearch.value);
      }
    });
  }

  let favoritesIcon = document.getElementById('favorites-button');
  if(favoritesIcon != null){
    favoritesIcon.addEventListener('mouseover', (event)=>{
      favoritesHover(favoritesIcon)
    });
    favoritesIcon.addEventListener('mouseleave', (event)=>{
      favoritesHover(favoritesIcon)
    });
    favoritesIcon.addEventListener('click', (event)=>{
      console.log("hi");
      favoritesHover(favoritesIcon);
    })
  }

  let statButtons = document.getElementsByClassName('stat-icon');
  [].forEach.call(statButtons, function(button){
    button.addEventListener('click', (event)=>{
      statButtonClick(button)
    });
  })

  let articleDelete = document.getElementById('article-delete-button');
  if(articleDelete != null){
    articleDelete.addEventListener('click', ()=>{
      console.log(article_id);
      let url = baseUrl + '/article/' + article_id;
      sendAjax('DELETE', url, null, ()=>{
        console.log("Article deleted!");
        window.location = baseUrl + '/article/destroyed';
      });
    });
  }

  let selectedCount = 0;
  let topicButtons = document.getElementsByClassName('topic-button');
  [].forEach.call(topicButtons, function(button){
    if(button.classList.contains('selected-topic')){
      selectedCount++;
    }
    button.addEventListener('click', (event)=>{
      topicButtonClick(button);
    });
  });
  let numTopicsCount = document.getElementById('num-selected-topics');
  if(numTopicsCount != null){
    numTopicsCount.innerText = selectedCount;
  }

  let applyTopicButton = document.getElementById('manage-topics-apply');
  if(applyTopicButton != null){
    applyTopicButton.addEventListener('click', (event)=>{
      applySelectedTopics(applyTopicButton)
    });
  }

  let notificationsButton = document.getElementById('header-notifications-thumbnail');
  notificationsButton.addEventListener('click', (event)=>{
    showNotifications(notificationsButton, notificationsButton);
  })

  let onload = addEventListener("load", function showThem(event){
    user_id = 23;
    let url = baseUrl + '/api/notification/' + user_id + '/new'
    let newNotifications;
    sendAjax('GET', url, null, function(response){
      newNotifications = response;
      if(newNotifications.length != 0){
        updateNotifications(newNotifications, notificationsButton);
      }
    });
  })

  let proposeTopicButton = document.getElementById('topic-proposal');
  proposeTopicButton.addEventListener('click', (event) => {
    createNotification('topic-pending');
  });

  let acceptTopicButton = document.getElementById('btn-accepted');
  acceptTopicButton.addEventListener('click', (event) => {
    createNotification('topic-pending');
  });

  let newCommentButton = document.getElementById('new-comment-button');
  newCommentButton.addEventListener('click', (event) => {
    createNotification('topic-pending');
  });

  let newArticleButton = document.getElementById('new-article-button')
  newArticleButton.addEventListener('click', (event) => {
    createNotification('topic-pending');
  });

  

}

function showNotifications(button){
  let notificationsBox = document.getElementById('notifications-box');
  let url = baseUrl + '/api/notification/' + user_id;
  console.log(url);
  sendAjax('GET', url, null, function(response){
    let notificationList = JSON.parse(response);
    if(notificationList.length > 0){
      let line = true;
      for(let i = 0; i < 15; i++){
        if(i > 6 && i == 14){
          line = false;
        }
        let data = {
          id: notificationList[i]['data'].id,
          content: notificationList[i]['data'].notificationdescription,
          href: notificationList[i]['href']
        }
        console.log(data);
        notificationsBox.appendChild(createNotification(data, line));
      };
    }
    else{
      notificationsBox.appendChild(createNotification({id: 0, content: 'Nothing to show'}, true))
    }
  });
  toggleHidden(notificationsBox);
}

function updateNotifications(notificationList, button){
  console.log(notificationList);
  let notificationsBox = document.getElementById('notifications-box');
  let buttonIcon = document.getElementById('header-notifications-button');
  buttonIcon.classList.replace('notifications-off', 'notifications-on');
  let notificationsNumber = document.getElementById('new-notifications-number');
  notificationsNumber.innerText = notificationList.length;
  toggleHidden(notificationsNumber);
  let line = true;
  button.addEventListener('click', (event) => {
    toggleHidden(notificationsNumber);
    buttonIcon.classList.replace('notifications-on', 'notifications-off');
    for(let i = 0; i < notificationList.length; i++){
      if(i > 6 && i == notificationList.length - 1){
        line = false;
      }
      let data = {
        id: notificationList[i]['data'].id,
        content: notificationList[i]['data'].notificationdescription,
        href: notificationList[i]['href']
      }
      notificationsBox.appendChild(createNotification(data, line));
    };
    let url = baseUrl + '/api/notification/' + user_id + '/seen';
    let params = {
      seen: JSON.stringify(notificationList)
    };
    sendAjax('POST', url, params, function(response){
      console.log(response)
    });
  })
}

function createNotification(type){
  let url = baseUrl + '/api/notification/new'
  switch($type){
    case 'article-comment':{
        createArticleComment(url);
        break;
    }
    case 'article-approved':{
        createArticleApproved(url);'topic-proposal'
        break;
    }
    case 'article-pending':{
        createArticlePending(url);
        break;
    }
    case 'topic-pending':{
        createTopicPending(url);
        break;
    }
    case 'topic-aprooved':{
        createTopicAprooved(url);
        break;
    }
    case 'friend-request':{
        createFriendRequest(url);
        break;
    }
    case 'friend-accepted':{
        createFriendAccept(url);
        break;
    }
  }
}

function createArticleComment(url){
  let params = {
    receiver_id : publisher_user_id,
    sender_id : user_id,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createArticleApproved(url){
  let params = {
    receiver_id : publisher_user_id,
    sender_id : 1,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createArticlePending(url){
  let params = {
    receiver_id : 1,
    sender_id : publisher_user_id,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createTopicPending(url){
  let params = {
    receiver_id : 1,
    sender_id : user_id,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createTopicAprooved(url){
  let params = {
    receiver_id : user_id,
    sender_id : 1,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createFriendRequest(url){
  let params = {
    receiver_id : publisher_friend_id,
    sender_id : user_id,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createFriendAccept(url){
  let params = {
    receiver_id : user_id,
    sender_id : publisher_friend_id,
    content_id : post_id,
    type: 'article-comment' 
  };
  sendAjax('POST', url, params, function(response){
    console.log(response);
  });
}

function createNotification(data, line){
  const notification = document.createElement('div');
  notification.classList.add('notification');
  notification.value = data.id;
  const notificationText = document.createElement('p');
  const href = document.createElement('a');
  href.href = data.href;
  console.log(data);
  notificationText.innerText = data.content;
  const frameLine = document.createElement('div');
  frameLine.classList.add('notification-frame-line')
  href.appendChild(notificationText);
  notification.appendChild(href);
  if(line){
    notification.appendChild(frameLine);
  }
  return notification;
}

function applySelectedTopics(applyTopicbutton){
  let selectedTopics = document.getElementsByClassName('added-topic');
  let removedTopics = document.getElementsByClassName('removed-topic');
  let selectedNum = document.getElementById('num-selected-topics').innerText;
  if(selectedNum > 0){
    if (selectedNum > 15 ){
      let notAllowd = document.getElementById('manage-topics-rejected');
      if(!notAllowd.classList.contains('visible')){
        notAllowd.classList.replace('hidden', 'visible');
      }
    }
    else{
      let selectedTopicsIds = [];
      for(let i = 0; i < selectedTopics.length; i++){
        selectedTopicsIds[i] = selectedTopics[i].value;
      }
      let removedTopicsIds = [];
      for(i = 0; i < removedTopics.length; i++){
        removedTopicsIds[i] = removedTopics[i].value;
      }
      let url = baseUrl + '/api/publisher/' + publisher_id + '/topics';
      let params = {
        selectedTopics : selectedTopicsIds,
        removedTopics: removedTopicsIds
      }
      sendAjax('POST', url, params, function(response) {console.log(response)});
    }
    [].forEach.call(selectedTopics, function(topic){
      topic.classList.replace('added-topic', 'selected-topic');
    });
    [].forEach.call(removedTopics, function(topic){
      topic.classList.replace('remove-topic', 'unselected-topic');
    });
  }
}

function topicButtonClick(button){
  let selectedCount = $('#num-selected-topics'); 
  console.log(button);
  if(button.classList.contains('selected-topic') || button.classList.contains('added-topic')){
    if(button.classList.contains('selected-topic')){
      button.classList.replace('selected-topic', 'removed-topic');
    }
    else{
      button.classList.replace('added-topic', 'unselected-topic')
    }
    decrementHtmlValue(selectedCount);
    if(selectedCount.text() <= 15){
      let countSelectedTopics = document.getElementById('count-selected-topics');
      if(countSelectedTopics.classList.contains('topic-overflow')){
        countSelectedTopics.classList.remove('topic-overflow');
      }
      let notAllowd = document.getElementById('manage-topics-rejected');
      if(notAllowd.classList.contains('visible')){
        notAllowd.classList.replace('visible', 'hidden');
      }
    }
  }
  else if(button.classList.contains('unselected-topic') || button.classList.contains('removed-topic')){
    if(button.classList.contains('unselected-topic')){
      button.classList.replace('unselected-topic', 'added-topic');
    }
    else{
      button.classList.replace('removed-topic', 'added-topic')
    }
    incrementHtmlValue(selectedCount);
    if(selectedCount.text() > 15){
      document.getElementById('count-selected-topics').classList.add('topic-overflow')
    }
  }
}

function incrementHtmlValue(value){
  let number = value.text();
  number++;
  value.text(number);
}

function decrementHtmlValue(value){
  let number = value.text();
  number--;
  value.text(number);
}

function changeStatValue(button, number){
  button.removeClass('stat-on').addClass('stat-off');
  decrementHtmlValue(number);
}

function statButtonClick(button){
  let target;
  let type;
  let op;
  let dislikeNumber = $('#dislike-number');
  let likeNumber = $('#like-number');
  switch(button.id){
    case 'like-button':{
      target=likeNumber;
      let dislikeButton = $('#dislike-button');
      if(dislikeButton.hasClass('stat-on')){
        changeStatValue(dislikeButton, dislikeNumber);
        type = 'change-dislike';
      }
      else{
        type='like'
      }
      break;
    }
    case 'dislike-button':{
      target=dislikeNumber;
      let likeButton = $('#like-button');
      if(likeButton.hasClass('stat-on')){
        changeStatValue(likeButton, likeNumber);
        type = 'change-like';
      }
      else{
        type='dislike'
      }
      break;
    }
    case 'favorites-button':{
      type='favorites'
      target=$('#favorites-number');
      break;
    }
  }
  let number = target.text();
  if(button.classList.contains('stat-on')){  console.log(target);
    button.classList.replace('stat-on', 'stat-off');
    number--;
    op = 'take';
  }
  else if(button.classList.contains('stat-off')){
    button.classList.replace('stat-off', 'stat-on');
    number++;
    op = 'add';
  }
  console.log(target);
  target.text(number);
  var params ={
    'user_id' : user_id,
    'type' : type,
    'op' : op
  }
  let url = baseUrl + '/api/post/' + post_id + '/vote';
  sendAjax('POST', url, params, function(response) {console.log(response)});
}

function sendAjax(requestType, url, data, handler){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(url, {
    type: requestType,
    data: data,
    async: true,
    success: function(response){
      handler(response);
    },
    failure: function(){
      console.log("Error: could not send request to " + url);
    }
  });
}

function favoritesHover(favoritesIcon){
  if(favoritesIcon.classList.contains('fa-regular')){
    favoritesIcon.classList.replace('fa-regular', 'fa-solid');
    favoritesIcon.classList.replace('stat-off', 'stat-on');
  }
  else{http://localhost:8000/api/notfication/28/new
    favoritesIcon.classList.replace('fa-solid', 'fa-regular')
    favoritesIcon.classList.replace('stat-on', 'stat-off');
  }
}

function processNewFilterOption(selectedType, filterOption){
  selectedType.innerText = filterOption.innerText;
  let favoritesOption = document.getElementById('sort-favorites');
  let sortOption = document.getElementById('selected-sort');
  let sortOptionMenu = document.getElementById('sort-option-menu');
  if(selectedType.innerHTML === 'Topics'){
    sortOption.innerText = 'Date'
    if(visible(favoritesOption)){
      toggleHidden(favoritesOption);
    }
    if(visible(sortOptionMenu)){
      toggleHidden(sortOptionMenu);
    }
  }
  else{
    if(hidden(sortOptionMenu)){
      toggleHidden(sortOptionMenu);
    }
    if(selectedType.innerText === 'Comments'){
      if(visible(favoritesOption)){
        toggleHidden(favoritesOption);
      }
    }
    else{
      if(hidden(favoritesOption)){
        toggleHidden(favoritesOption);
      }
    }
  }
}

function hidden(target){
  return target.classList.contains('hidden');
}

function visible(target){
  return target.classList.contains('visible');
}

function toggleHidden(target){
  if(target.classList.contains('visible')){
    target.classList.replace('visible', 'hidden')
  }
  else if(target.classList.contains('hidden')){
    target.classList.replace('hidden', 'visible')
  }
}

function searchWithFilters(target){
  let selectedType = document.getElementById("selected-type").innerText;
  let selectedSort = document.getElementById("selected-sort").innerText;
  let selectedOrder = document.getElementById("selected-order").innerText;
  let selectedSearch = document.getElementById("selected-search").innerText;
  let url = baseUrl + '/search?';
  url = setType(url, selectedType);
  url = setSort(url, selectedSort);
  url = setOrder(url, selectedOrder);
  url = setSearch(url, selectedSearch);
  url += 'target=' + target;
  window.location=url;
}

function setType(url, type){
  if(type != "All"){
    return url + 'type=' + type.toLowerCase() + '&';
  }
  return url;
}

function setSort(url, sort){
  if(sort != "Reputation"){
    return url + 'sort=' + sort.toLowerCase() + '&';
  }
  return url;
}

function setOrder(url, order){
  if(order != "Descending"){
    return url + 'order=' + order.toLowerCase() + '&';
  }
  return url;
}

function setSearch(url, search){
  if(search != "Full-Text"){
    return url + 'search=' + 'exactMatch' + '&';
  }
  return url;
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function fullTextSearch(value){
  var xhr = new XMLHttpRequest();
  let url = baseUrl + '/search?target=' + value;
  window.location = url;
}


function sendItemUpdateRequest() {
  let item = this.closest('li.item');
  let id = item.getAttribute('data-id');
  let checked = item.querySelector('input[type=checkbox]').checked;

  sendAjaxRequest('post', '/api/item/' + id, {done: checked}, itemUpdatedHandler);
}

function sendDeleteItemRequest() {
  let id = this.closest('li.item').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/item/' + id, null, itemDeletedHandler);
}

function sendDeleteCommentRequest() {
  let id = document.getElementById('comment').getAttribute('data-id');

  sendAjaxRequest('get', '/api/comment/' + id + '/delete', null, commentDeletedHandler);
}

function sendCreateItemRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  let description = this.querySelector('input[name=description]').value;

  if (description != '')
    sendAjaxRequest('put', '/api/cards/' + id, {description: description}, itemAddedHandler);

  event.preventDefault();
}

function sendCreateCommentRequest() {
  let publisher = document.querySelector('input[name=new-comment-publisher]').value;
  let article = document.querySelector('input[name="new-comment-article"]').value;
  let content = document.querySelector('textarea[name=content]').value;
  console.log(content);
  console.log(publisher);
  console.log(article);
  
  var params = {
    publisher_id: publisher,
    article_id: article,
    content: content
  };

  console.log(params);
  if (content != ''){
    sendAjaxRequest('post', '/api/comment/', params, commentAddedHandler);
  }
}

function sendUpdateNumberComment() {
  let post = document.querySelector('input[name="new-comment-post-article"]').value;
  console.log(post);
  let url = baseUrl + '/api/post/' + post + '/comment';
  sendAjaxRequest('post', url, {id: post}, numberComment);
}

function numberComment() {
  console.log(this.responseText);
}

function commentAddedHandler() {
  console.log(this.responseText);
  if (this.status != 200) {console.log('Erro no inicio do commentAdded'); return;}
  console.log(this);
  let resp = JSON.parse(this.responseText);
  console.log(resp);

  let comment = resp['comment']; let username = resp['publisher_name'];

  let new_comment = document.createElement('div');
  new_comment.classList.add('new');
  new_comment.setAttribute('data-id', comment.id);

  let container = document.querySelector('div.info-container');
  let title = document.createElement('h3'); title.setAttribute('id', 'title-new-comment');
  title.textContent = "New Comment";
  container.append(title);
 
  let content = document.createElement('div'); 
  content.setAttribute('id', 'comment-content-id'); content.textContent = comment.content;

  let publisher_content = document.createElement('a');
  publisher_content.setAttribute('id', 'comment-publisher-id');
  publisher_content.textContent = username;

  let data_content = document.createElement('div');
  data_content.setAttribute('id', 'comment-data-id');
  data_content.textContent = 'Acabado de publicar';
  
  new_comment.append(publisher_content);
  new_comment.append(data_content);
  new_comment.append(content);
  console.log(new_comment);
  container.append(new_comment);

  let form = document.querySelector('div#textarea-commet textarea#new-comment-box');
  console.log(form);
  form.value="";

  sendUpdateNumberComment();
}

addEventListeners();
