/*
Biblioteca para a execução de videos com referencia

dependencias da lib:
  <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
*/

//Controlador do player de videos com referencias 

class VideoPlayerCreator {

    constructor(video) {
        let mainVideo = video;

        if (mainVideo == null) {
            mainVideo = new VideoModel("new", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4", "");
            mainVideo.setContend("Titulo", "Descrição", 200);
            mainVideo.setReference([
                new VideoReferenceModel("new", "http://www.aichibooks.com.tw/images/play.png", 10, "Titulo1", "Descrição 1", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4"),
                new VideoReferenceModel("new", "http://www.aichibooks.com.tw/images/play.png", 20, "Titulo2", "Descrição 2", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4"),
                new VideoReferenceModel("new", "http://www.aichibooks.com.tw/images/play.png", 30, "Titulo3", "Descrição 3", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4"),
                new VideoReferenceModel("new", "http://www.aichibooks.com.tw/images/play.png", 100, "Titulo4", "Descrição 4", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 123, "Outro Video ", "Teste para outro video", "https://addpipe.com/sample_vid/pink-swan.mp4")
            ]);

            var exemplo2 = new VideoModel("id_02", "https://addpipe.com/sample_vid/pink-swan.mp4", "");
            exemplo2.setReference([
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 15, "V2Titulo", "Descrição 1", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 25, "V2Titulo", "Descrição 2", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 35, "V2Titulo", "Descrição 3", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 150, "V2Titulo", "Descrição 4", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 200, "V2Titulo", "Descrição 5", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("id_02", "http://www.aichibooks.com.tw/images/play.png", 250, "V2Titulo", "Descrição 6", "https://addpipe.com/sample_vid/pink-swan.mp4"),
                new VideoReferenceModel("new", "http://www.aichibooks.com.tw/images/play.png", 123, "Outro Video ", "Teste para outro video", "https://tutorialehtml.com/assets_tutorials/media/Shaun-the-Sheep-The-Movie-Official-Trailer.mp4")
            ]);
        }

        var createplayer = new VideoPlayerController(mainVideo);
        createplayer.add(exemplo2);

        //Video atual sendo exibido
        this.mainVideo = mainVideo;
        //DOM do html5 <video> onde é exibido o video
        this.preview = createplayer;
        //DOM do div de lista de videos
        this.FRefList = this.mainVideo.FHistory;
        this.refContainer = null;
        this.FContainerBox = null;
    }

    //Adiciona um video a lista de videos conhecidos;
    add(video) {

        this.FVideos[video.id] = video;
        return this.FVideos[video.id];
    }


    //Carrega video no tempo 0;
    load() {
        this.preview.src = this.currentVideo.FSource;
        this.preview.currentTime = 0;
    }
    load(time) {
        this.preview.src = this.currentVideo.FSource;
        this.preview.currentTime = time;
    }
    jumpToRef(aRef) {
        this.preview.jumpToRef(aRef);


    }
    setMainVideo(src) {
        this.mainVideo.FSource = src;
        this.preview.src = src;
    }

    addInternalReference() {
        this.preview.pause();
        const newRef = VideoReferenceModel.newSimple(this.mainVideo.id, this.preview.FPlayer.currentTime, this.preview.FPlayer.src);
        this.FRefList = this.FRefList.concat(newRef);
        this.refreshReference();


    }

    getExternal() {
        return new VideoModel();
    }
    addExternalReference() {
        this.preview.pause();
        var extVideo = this.getExternal()
        const newRef = VideoReferenceModel.newSimple(extVideo.id, this.preview.FPlayer.currentTime, extVideo.path);
        this.FRefList = this.FRefList.concat(newRef);
        this.refreshReference();



    }


    refreshReference() {
        this.FRefList.sort((a, b) => {
            var at = a.listTime ? a.listTime : a.time
            var bt = b.listTime ? b.listTime : b.time
            return at - bt;

        }
        )
        this.showReference(this.refConteiner);

    }
    showReference(container) {
        clearChild(container);
        this.refConteiner = container;
        let context = this;
        let refList = this.FRefList;
        for (let i = 0; i < refList.length; i++) {
            let ref = refList[i];
            let actual_video = this.FVideo;

            var div = createDiv({ class: "videoNewItemBox" }, container);
            var b = createElement("img", { class: "videoPreviewEdit", src: ref.prevPic }, div);
            b.innerText = ref.prevPic;
            b = createDiv({ class: "videoContendEdit" }, div);
            this
            var onFocus = function (event) {
                if (ref.id == context.mainVideo.id || confirm("Esta é uma referencia externa ao video em edição, deseja reproduzila?")) {
                    context.jumpToRef(ref);
                }
            }

            var inp = createInput({ type: "text", class: "videoTitleInput", label: "Titulo", value: ref.title }, b, "titulo" + i);
            inp.addEventListener('focusin', onFocus);
            inp.addEventListener("change", (event) => {
                ref.title = event.target.value;
            });
            var inp = createInput({ type: "text", class: "videoDescriptionInput", label: "Descrição", value: ref.descrption }, b, "desc" + i);
            inp.addEventListener('focusin', onFocus);
            inp.addEventListener("change", (event) => {
                ref.descrption = event.target.value;
                context.refreshReference();
            });
            var inp = createInput({ type: "text", class: "videoTimeInput", label: "Tempo (mm:ss)", value: ref.time }, b, "time" + i);
            inp.addEventListener('focusin', onFocus);
            inp.addEventListener("change", (event) => {
                ref.time = event.target.value;
                context.refreshReference();
            });

            if (ref.id != context.mainVideo.id) {
                var inp = createInput({ type: "text", class: "videoTimeInput", label: "Linha do tempo", value: ref.time }, b, "listTime" + i);
                inp.addEventListener('focusin', onFocus);
                inp.addEventListener("change", (event) => {
                    ref.listTime = event.target.value;
                    context.refreshReference();
                });
            }

            let btn = createButton({ id: "rmv_" + i, class: "referenceRemoveButton" }, div);
            btn.innerText = "Remover";
            btn.addEventListener('click', function () {
                context.FRefList.splice(i, 1);
                context.refreshReference();

            }
            )

        };

    }
    finish() {
        this.mainVideo.FHistory = this.FRefList;
        alert(this.mainVideo.toString());
        //TODO: Enviar para o servidor

    }
}
