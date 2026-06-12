<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="t_documento_id" value="Tipo Documento" />
                    <select name="t_documento_id" id="t_documento_id"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm py-2 px-3 text-sm text-gray-700">
                        @foreach($tiposDocumento as $tipo)
                            <option value="{{ $tipo->id_t_doc }}">
                                {{ $tipo->n_doc }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('t_documento_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="n_documento" value="Número Documento" />
                    <x-text-input
                        id="n_documento"
                        class="block mt-1 w-full"
                        type="text"
                        name="n_documento"
                        :value="old('n_documento')"
                        required
                    />
                    <x-input-error :messages="$errors->get('n_documento')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="primer_nombre" value="Primer Nombre" />
                    <x-text-input
                        id="primer_nombre"
                        class="block mt-1 w-full"
                        type="text"
                        name="primer_nombre"
                        :value="old('primer_nombre')"
                        required
                    />
                    <x-input-error :messages="$errors->get('primer_nombre')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="segundo_nombre" value="Segundo Nombre" />
                    <x-text-input
                        id="segundo_nombre"
                        class="block mt-1 w-full"
                        type="text"
                        name="segundo_nombre"
                        :value="old('segundo_nombre')"
                    />
                    <x-input-error :messages="$errors->get('segundo_nombre')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="primer_apellido" value="Primer Apellido" />
                    <x-text-input
                        id="primer_apellido"
                        class="block mt-1 w-full"
                        type="text"
                        name="primer_apellido"
                        :value="old('primer_apellido')"
                        required
                    />
                    <x-input-error :messages="$errors->get('primer_apellido')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="segundo_apellido" value="Segundo Apellido" />
                    <x-text-input
                        id="segundo_apellido"
                        class="block mt-1 w-full"
                        type="text"
                        name="segundo_apellido"
                        :value="old('segundo_apellido')"
                    />
                    <x-input-error :messages="$errors->get('segundo_apellido')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="numero_tel" value="Número Teléfono" />
                    <x-text-input
                        id="numero_tel"
                        class="block mt-1 w-full"
                        type="text"
                        name="numero_tel"
                        :value="old('numero_tel')"
                        required
                    />
                    <x-input-error :messages="$errors->get('numero_tel')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Correo Electrónico" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="password" value="Contraseña" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation"
                        required
                    />
                </div>
            </div>

        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>

            <x-primary-button class="ms-4">
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>