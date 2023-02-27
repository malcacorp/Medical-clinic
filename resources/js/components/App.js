import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import MediaHandler from '../MediaHandler';



export default class App extends Component{

    constructor(){

        super();
        this.state= {
            hasMedia : false,
            otherUserId :null
        };
   
        this.mediaHandler = new MediaHandler();
        
    }
    componentDidMount(){

        this.mediaHandler.getPermissions()
        .then( (stream) => {
            this.setState({hasMedia:true});

        
            try{
                this.myVideo.srcObject = stream;
            }catch(e){
                this.myVideo.src=URL.createObjectURL(stream);
            }
            this.myVideo.play();
        })

    }

    setupPusher(){

        this.pusher = new pusher(APP_KEY,{

            authEndPoint: '/pusher/auth',
            cluster:ap2,
            auth:{

                params:this.user.id,
                header:{
                    'X-CSRF-Token': window.csrfToken
                }

            }

        })

    }

     render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="video-container">
                                <video className="My-video" ref={(ref) => {this.myVideo= ref ;}}></video>
                            </div>
    
                            <div className="video-container">
                            <video className="User-video" ref={(ref) => {this.userVideo= ref ;}}></video>
                            <video></video>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        );
    }
}

if (document.getElementById('App')) {
    ReactDOM.render(<App />, document.getElementById('App'));
}
