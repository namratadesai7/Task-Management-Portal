.main{
    position: absolute; 
    width:calc(100% -300px); 
    left:300px;
    min-height: 100vh; 
    background: var(--white);
    transition: 0.5s;
   
} 

.topbar{
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center; 
    
}

.toggle{
    position: relative;
   
    top:0;
    width:60px;
    height:60px;
    background: #ccc;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2.5em;
    cursor:pointer;
}   
.search label{
    position: relative;
    width:100%;

}
.search label input{
    width:100%;
    height: 40px;
    border-radius:40px; 
    padding:5px 35px;
    font-size: 18px;
    outline:none;
    border:1px solid var(--black2);

}

.search label i{
    position:absolute;
    top:0;
    left:10px;
    font-size:1.2rem;

}
.user{
    position: relative;
    min-width: 40px;
    height:40px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
}


