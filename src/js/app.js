
export const sendit = async(location, senddata ) => {
    const settings = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body:senddata
    };
    try {
        const fetchResponse = await fetch(location, settings);
        const receivedata = await fetchResponse.json();
        if(receivedata.status == 200){
            return receivedata;
        } else {
            return receivedata;
        }
        // do success stuff
    } catch (e) {
        console.log(e);
        return e;
    } 

} 
