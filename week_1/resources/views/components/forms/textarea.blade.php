<textarea id="{{ $id }}" class="
    form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
    focus:outline-none focus:shadow-outline
    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
" name="{{ $name }}">{{ old($name) ?? $value }}</textarea>
