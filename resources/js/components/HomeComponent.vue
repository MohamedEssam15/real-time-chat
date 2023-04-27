<template>
<div>
    Welcome:{{message}}
</div>
</template>
<script>
export default{
name: "HomeComponent",
data(){

    return{
        message:''
    }

},
mounted(){
    window.Echo.channel('messages').listen('Message',event=>{
        this.message =event.message
    });
}
}



</script>
