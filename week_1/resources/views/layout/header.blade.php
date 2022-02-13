<nav class="flex items-center justify-between flex-wrap bg-teal p-6">
    <div class="flex items-center flex-no-shrink text-black mr-6">
        <svg class="h-8 w-8 mr-2" width="128" height="128" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"
             preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path
                    d="M575 1119 c-174 -24 -317 -146 -375 -319 -41 -121 -15 -321 54 -419 131 -183 333 -255 539 -191 134 42 256 180 297 339 24 89 25 135 5 219 -34 143 -116 254 -232 314 -109 57 -184 72 -288 57z m10 -319 l-69 -70 -58 0 -58 0 0 70 0 70 127 0 127 0 -69 -70z m295 0 l0 -70 -127 0 -127 0 69 70 69 70 58 0 58 0 0 -70z m-413 -137 c-16 -16 -15 -19 20 -55 l37 -38 -62 0 -62 0 0 55 0 55 42 0 c40 0 41 -1 25 -17z m333 -38 l54 -55 -105 0 -105 0 -39 40 c-54 55 -40 70 64 70 l77 0 54 -55z m80 -117 c0 -7 -23 -36 -52 -65 l-52 -53 -188 0 -188 0 0 65 0 65 240 0 c182 0 240 -3 240 -12z"/>
            </g>
        </svg>
        <span class="font-semibold text-xl tracking-tight">{{ env('APP_NAME') }}</span>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="{{ route("boards") }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter mr-4">
                글 목록
            </a>
        </div>
    </div>
</nav>
