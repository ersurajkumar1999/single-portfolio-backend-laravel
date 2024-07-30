<div class="app-chat overflow-hidden card">
  <div class="row g-0">
    <style>
      .loading {
      display: inline-flex;
      align-items: center;
      }
    </style>
    <!-- Chat History -->
    <div class="col app-chat-history">
      <div class="chat-history-wrapper">
        <div class="chat-history-header border-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex overflow-hidden align-items-center">
              <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
              <div class="flex-shrink-0 avatar">
                <img src="{{asset('assets/images/logo/openai.svg')}}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
              </div>
              <div class="chat-contact-info flex-grow-1 ms-3">
                <h6 class="m-0">Chat GPT</h6>
                <small class="user-status text-muted">Open AI</small>
              </div>
            </div>
            <div class="d-flex align-items-center">
              <div class="dropdown">
                <button class="btn p-0" type="button" id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded fs-4"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                  <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="chat-history-body chat-body">
          <div class="chat-preloading">
            <img src="{{asset('assets/images/logo/preloading.svg')}}" alt="preloading">
          </div>

          <ul class="list-unstyled chat-history mb-0">
          <!-- <li class="chat-message">
              <div class="d-flex overflow-hidden">
                <div class="user-avatar flex-shrink-0 me-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/logo/openai.svg')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">Hey John, 454444455454544545454</p>
                    <p class="mb-0">Could you please help me to find it out? 🤔</p>
                  </div>
                  <div class="chat-message-text mt-2">
                    <p class="mb-0">It should be Bootstrap 5 compatible.</p>
                  </div>
                  <div class="text-muted mt-1">
                    <small>10:02 AM</small>
                  </div>
                </div>
              </div>
            </li>
            <li class="chat-message chat-message-right">
              <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                  <div class="chat-message-text">
                    <p class="mb-0">Sneat has all the components you'll ever need in a app.</p>
                  </div>
                  <div class="text-end text-muted mt-1">
                    <i class='bx bx-check-double text-success'></i>
                    <small>10:03 AM</small>
                  </div>
                </div>
                <div class="user-avatar flex-shrink-0 ms-3">
                  <div class="avatar avatar-sm">
                    <img src="{{asset('assets/images/default.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                </div>
              </div>
            </li>-->
          </ul>
        </div>
        <!-- Chat message form -->
        <div class="chat-history-footer">
          <form id="sendMessageForm" class="form-send-message d-flex justify-content-between align-items-center ">
            <input name="message" id="message" class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here...">
            <div class="message-actions d-flex align-items-center">
              <i class="speech-to-text bx bx-microphone bx-sm cursor-pointer"></i>
              <label for="attach-doc" class="form-label mb-0">
                <i class="bx bx-paperclip bx-sm cursor-pointer mx-3 text-body"></i>
                <input type="file" id="attach-doc" hidden>
              </label>
              <button type="submit" class="btn btn-primary d-flex send-msg-btn-loading">
                <div class="spinner-border" role="status"></div>
                <span class="align-middle d-md-inline-block d-none "> sending...</span>
              </button>
              <button type="submit" class="btn btn-primary d-flex send-msg-btn">
                <i class="bx bx-paper-plane me-md-1 me-0 send-icon"></i>
                <span class="align-middle d-md-inline-block d-none">Send</span>
              </button>

            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Chat History -->

    <div class="app-overlay"></div>
  </div>
</div>
