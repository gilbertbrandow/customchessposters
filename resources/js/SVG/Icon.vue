<template>

    <svg v-if="name === 'user'" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0"
        y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
        <g>
            <g>
                <path d="M333.187,237.405c32.761-23.893,54.095-62.561,54.095-106.123C387.282,58.893,328.389,0,256,0
			S124.718,58.893,124.718,131.282c0,43.562,21.333,82.23,54.095,106.123C97.373,268.57,39.385,347.531,39.385,439.795
			c0,39.814,32.391,72.205,72.205,72.205H400.41c39.814,0,72.205-32.391,72.205-72.205
			C472.615,347.531,414.627,268.57,333.187,237.405z M164.103,131.282c0-50.672,41.225-91.897,91.897-91.897
			s91.897,41.225,91.897,91.897S306.672,223.18,256,223.18S164.103,181.954,164.103,131.282z M400.41,472.615H111.59
			c-18.097,0-32.82-14.723-32.82-32.821c0-97.726,79.504-177.231,177.231-177.231s177.231,79.504,177.231,177.231
			C433.231,457.892,418.508,472.615,400.41,472.615z" fill="currentColor"></path>
            </g>
        </g>
    </svg>

    <svg v-else-if="name === 'bookmark'" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0"
        y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
        <g>
            <path
                d="M26,31a1,1,0,0,1-.573-.181L16,24.221l-9.427,6.6A1,1,0,0,1,5,30V5.8A4.805,4.805,0,0,1,9.8,1H22.2A4.805,4.805,0,0,1,27,5.8V30a1,1,0,0,1-1,1ZM16,22a1,1,0,0,1,.573.181L25,28.079V5.8A2.8,2.8,0,0,0,22.2,3H9.8A2.8,2.8,0,0,0,7,5.8V28.079l8.427-5.9A1,1,0,0,1,16,22Z"
                fill="currentColor" class=""></path>
        </g>
    </svg>

    <svg v-else-if="name === 'cart'" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0"
        y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
        <g>
            <g data-name="Layer 2">
                <path
                    d="M16 17.82A6 6 0 0 1 10.11 13a1 1 0 0 1 1-1.15 1 1 0 0 1 1 .83 4 4 0 0 0 7.83 0 1 1 0 0 1 1-.83 1 1 0 0 1 1 1.15A6 6 0 0 1 16 17.82z"
                    fill="currentColor"></path>
                <path
                    d="M24.9 31H7.1a3 3 0 0 1-3-3.15l.81-17.24a3 3 0 0 1 3-2.87h16.18a3 3 0 0 1 3 2.87l.81 17.24a3 3 0 0 1-3 3.15zM7.91 9.75a1 1 0 0 0-1 1l-.81 17.2a1 1 0 0 0 1 1.05h17.8a1 1 0 0 0 1-1.05l-.81-17.24a1 1 0 0 0-1-1z"
                    fill="currentColor"></path>
                <path d="M22 8.75h-2V7a4 4 0 0 0-8 0v1.75h-2V7a6 6 0 0 1 12 0z" fill="currentColor">
                </path>
            </g>
        </g>
    </svg>

    <svg v-else-if="name === 'dropdown'" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
        <g id="_16" data-name="16">
            <path
                d="m12 16a1 1 0 0 1 -.71-.29l-6-6a1 1 0 0 1 1.42-1.42l5.29 5.3 5.29-5.29a1 1 0 0 1 1.41 1.41l-6 6a1 1 0 0 1 -.7.29z" />
        </g>
    </svg>

</template>

<script>
export default {
    props: {
        name: '',
    }
}
</script>