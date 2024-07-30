@extends('layout.main', [
'title' => 'Chat GPT',
])

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- <h4 class="py-1 mb-1"><span class="text-muted fw-light">Dashboard /</span> Chat GPT</h4> -->
  @include('open-ai.open-ai-section')
</div>
@endsection

@section('js_script')
<script type="text/javascript">
  let chats = [];
  let bot_avatar = "";
  let user_avatar = "";


  $(document).ready(function() {
    const dynamicChatList = document.querySelector(".chat-history");;
    const sendMsgBtn = document.querySelector(".send-msg-btn");
    const sendMsgBtnLoading = document.querySelector(".send-msg-btn-loading");
    sendMsgBtn.style.display = 'flex';
    sendMsgBtnLoading.style.display = 'flex';
    let currentPage = 1;
    loadChatHistory(currentPage);
    $('#sendMessageForm').on('submit', function(event) {
      event.preventDefault();
      toggleLoading(true);
      let code = makeid(10);
      let formData = new FormData(this);
      $('#sendMessageForm')[0].reset();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('open-ai.store') }}", // Replace with your route
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(chatRresponse) {
          if (chatRresponse.status) {
            let data = chatRresponse.data;
            $('#sendMessageForm')[0].reset();
            dynamicChatList.scrollTop = dynamicChatList.scrollHeight;
            appendMessage(user_avatar, data, code)

            let chatURL = "{{route('open-ai.chat-process')}}";

            eventSource = new EventSource(chatURL + "?chat_id=" + data.id);
            const response = document.getElementById(code);

            eventSource.onopen = function(e) {
              response.innerHTML = '';
            };

            eventSource.addEventListener('update', function(event) {
              console.log("event========>", event.data);
                if (event.data === "<DONE>") {
                  eventSource.close();
                    return;
                }

              response.innerText += event.data
              // Scroll to the end of the div
              dynamicChatList.scrollTop = dynamicChatList.scrollHeight;
            });
          }
        },
        error: function(xhr) {
          toastr.error('An error has occurred, please try again later.');
        }
      });
    });

    function loadChatHistory(page) {
      setChatPreloading(true);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: "{{route('open-ai.index')}}",
        data: {
          'page': page
        },
        success: function(response) {
          if (response.status) {
            let data = response.data.data;
            chats.unshift(...data);
            setChatHistory();
            setChatPreloading(false);
          }

          // hljs.highlightAll();
          // Scroll to the end of the div

        },
        error: function(xhr, status, error) {
          // Display a custom error message
          // alert("Something went wrong, please try again.");
          setChatPreloading(false);
        }
      });
    }
    function appendMessage(avatar, chat, code = null) {
      console.log("avatar:", avatar);
      console.log("chat:", chat);
      console.log("code:", code);
      let msgHTML;
      let response = "";
      let botResponseHTML = `
            <li class="chat-message">
              <div class="d-flex overflow-hidden">
                <div class="user-avatar flex-shrink-0 me-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/logo/openai.svg')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0" id="${code}"><img width="100" height="100" src="{{asset('assets/images/logo/typing.svg')}}" alt="preloading"></p>
                  </div>
                  <div class="text-muted mt-1">
                    <small>10:05 AM</small>
                  </div>
                </div>
              </div>
            </li>`
      msgHTML = `
            <li class="chat-message chat-message-right">
                <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">${chat.message}</p>
                  </div>
                  <div class="text-end text-muted mt-1">
                    <i class='bx bx-check-double text-success'></i>
                    <small>${chat.time}</small>
                  </div>
                </div>
                <div class="user-avatar flex-shrink-0 ms-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/default.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
              </div>
            </li>`;
      finalHTML =  (msgHTML + (code ? botResponseHTML: ''));
      dynamicChatList.insertAdjacentHTML("beforeend", finalHTML);
    }

    function appendMessageSpecial(avatar, chat) {
      let msgHTML;
      msgHTML = `
            <li class="chat-message">
              <div class="d-flex overflow-hidden">
                <div class="user-avatar flex-shrink-0 me-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/logo/openai.svg')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">${chat.message}</p>
                  </div>
                  <div class="text-muted mt-1">
                    <small>${chat.time}</small>
                  </div>
                </div>
              </div>
            </li>`;

      dynamicChatList.insertAdjacentHTML("beforeend", msgHTML);
      // msgerChat.scrollTop += 500;
    }

    function setChatHistory() {
      chats.forEach((chat, index) => {
        if (chat.from == "BOT") {
          appendMessageSpecial(bot_avatar, chat);
        }
        if (chat.from == "USER") {
          appendMessage(user_avatar, chat);
        }
        console.log("dynamicChatList", dynamicChatList);
        console.log("dynamicChatList.scrollTop", dynamicChatList.scrollTop);
        console.log("dynamicChatList.scrollHeight", dynamicChatList.scrollHeight);

        dynamicChatList.scrollTop = dynamicChatList.scrollHeight;
      });

      // hljs.highlightAll(); // Re-highlight code blocks if any
    }

    function setChatPreloading(status) {
      $('.chat-preloading').css({
        'display': status ? 'block' : 'none'
      });
    }

    function toggleLoading(isLoading) {
      if (isLoading) {
        $('.send-msg-btn-loading').css({
          'display': isLoading ? 'block' : 'none'
        });
        $('.send-msg-btn').css({
          'display': isLoading ? 'none' : 'block'
        });
      } else {
        $('.send-msg-btn-loading').css({
          'display': isLoading ? 'none' : 'none'
        });
        $('.send-msg-btn').css({
          'display': isLoading ? 'block' : 'none'
        });
      }
    }

    // Generate a random value
    function makeid(length) {
      let result = '';
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      const charactersLength = characters.length;
      let counter = 0;
      while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
      }
      return result;
    }
  })
</script>
@endsection
