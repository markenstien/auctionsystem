<!DOCTYPE html>
<html>
<?php session_start();?>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Live Steam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" v27Jm3lZgsEi1MDQySbQ0Tk1LMzFLsrRINjIzM041NTc3Tkq2NEqb7ymX2hDIyLB3gigLIwMEgviCDD6ZZanBJUWpiblOmSkpmXnpDAwA54IhWg href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <style>
    a#fullscreen_btn i {
      position: relative;
      left: 4px;
      top: 1px;
      color: #ffff;
    }

    a#fullscreen_btn {
      border-radius: 50%;
      padding: 13px 16px;
      width: 54px;
      background-color: #3C4043;
    }
    #video-streams {
      height: 265px !important;
  }
 .agora_video_player {
    height: 125% !important;
}
.video-player {
    height: 127% !important;
}
div#stream-controls button {
    z-index: 999999999;
}
.agora_video_player {
    border-radius: 0px !important;
    margin-top: 0px !important;
}
  </style>
</head>

<body>
  <button id="join-btn">Join Stream</button>

  <div id="stream-wrapper" class="container-fluid">
    <div id="video-streams"></div>
    <div id="stream-controls">
      <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 'seller') : ?>
        <button id="mic-btn"><i class="fa-solid fa-microphone"></i></button>
        <button id="camera-btn"><i class="fa-solid fa-video"></i></button>
      <?php endif; ?>
      <button id="leave-btn"><i class="fa-solid fa-phone"></i></button>
      <!-- <a target="_blank" href="http://localhost/EZauction/live-api/" id="fullscreen_btn"><i class="fa-solid fa-expand"></i></a> -->
    </div>
  </div>
</body>
<script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="AgoraRTC_N-4.7.3.js"></script>
<script>
  // fullscreen_btn.onclick = () => {
  //   window.location = 'http://localhost/EZauction/live-api/';
  // }
  const checking = () => {
    setInterval(() => {
      let listView = document.querySelectorAll('.video-container');
      for (let i = 0; i < listView.length; i++) {
        // let splitID = listView[i].getAttribute("id").split("-");
        if (i > 0) {
          listView[i].remove();
        }
      }
    }, 100);
  }

  const APP_ID = "7bd6baeef74341a0b8fc287d35d3030b";
  const TOKEN =
    "007eJxTYDiw49ItLs7rATJR1Xv2Sl1xj3/7+oKZpLVM19996eufL4pVYDBPSjFLSkxNTTM3MTYxTDRIskhLNrIwTzE2TTE2MDZImnrQNLUhkJHBa6IvAyMUgvgcDK5RoY4hnv5+DAwASHgheQ==";
  const CHANNEL = "EZUATION";

  const client = AgoraRTC.createClient({
    mode: "rtc",
    codec: "vp8"
  });

  let localTracks = [];
  let remoteUsers = {};

  let joinAndDisplayLocalStream = async () => {

    client.on("user-published", handleUserJoined);

    client.on("user-left", handleUserLeft);

    let UID = await client.join(APP_ID, CHANNEL, TOKEN, null);

    localTracks = await AgoraRTC.createMicrophoneAndCameraTracks();

    let player = `<div class="video-container" id="user-container-${UID}">
                        <div class="video-player" id="user-${UID}"></div>
                  </div>`;
    document
      .getElementById("video-streams")
      .insertAdjacentHTML("beforeend", player);

    localTracks[1].play(`user-${UID}`);

    await client.publish([localTracks[0], localTracks[1]]);
    checking();
  };

  let joinStream = async () => {
    await joinAndDisplayLocalStream();
    document.getElementById("join-btn").style.display = "none";
    document.getElementById("stream-controls").style.display = "flex";
  };

  let handleUserJoined = async (user, mediaType) => {
    remoteUsers[user.uid] = user;
    await client.subscribe(user, mediaType);

    if (mediaType === "video") {
      let player = document.getElementById(`user-container-${user.uid}`);
      if (player != null) {
        player.remove();
      }

      player = `<div class="video-container" id="user-container-${user.uid}">
                        <div class="video-player" id="user-${user.uid}"></div> 
                 </div>`;
      document
        .getElementById("video-streams")
        .insertAdjacentHTML("beforeend", player);

      user.videoTrack.play(`user-${user.uid}`);
    }

    if (mediaType === "audio") {
      user.audioTrack.play();
    }
  };

  let handleUserLeft = async (user) => {
    delete remoteUsers[user.uid];
    document.getElementById(`user-container-${user.uid}`).remove();
  };

  let leaveAndRemoveLocalStream = async () => {
    for (let i = 0; localTracks.length > i; i++) {
      localTracks[i].stop();
      localTracks[i].close();
    }

    await client.leave();
    document.getElementById("join-btn").style.display = "block";
    document.getElementById("stream-controls").style.display = "none";
    document.getElementById("video-streams").innerHTML = "";
  };

  let toggleMic = async (e) => {
    let micOff = document.querySelector(".fa-microphone-slash"),
      micOn = document.querySelector(".fa-microphone");

    if (localTracks[0].muted) {
      await localTracks[0].setMuted(false);
      micOff.classList.add("fa-microphone");
      micOff.classList.remove("fa-microphone-slash");
    } else {
      await localTracks[0].setMuted(true);
      micOn.classList.add("fa-microphone-slash");
      micOn.classList.remove("fa-microphone");
    }
  };

  let toggleCamera = async (e) => {
    let vidOff = document.querySelector(".fa-video-slash"),
      vidOn = document.querySelector(".fa-video");

    if (localTracks[1].muted) {
      await localTracks[1].setMuted(false);

      vidOff.classList.add("fa-video");
      vidOff.classList.remove("fa-video-slash");
    } else {
      await localTracks[1].setMuted(true);

      vidOn.classList.add("fa-video-slash");
      vidOn.classList.remove("fa-video");
    }
  };

  document.getElementById("join-btn").addEventListener("click", joinStream);
  document
    .getElementById("leave-btn")
    .addEventListener("click", leaveAndRemoveLocalStream);
  document.getElementById("mic-btn").addEventListener("click", toggleMic);
  document
    .getElementById("camera-btn")
    .addEventListener("click", toggleCamera);
</script>

</html>