<div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
    
    <div class="w-full max-w-lg p-6 bg-white shadow-xl sm:p-8 rounded-xl">
        <form action="{{ route('lancamentos.criaDespesa') }}" method="POST" class="space-y-5">
            @csrf

            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold tracking-tight text-[#615ACD] md:text-3xl">Nova Despesa</h2>
                <p class="mt-1 text-sm text-gray-500">Preencha os dados abaixo para registrar a despesa.</p>
            </div>

            <div>
                <label for="descricao" class="block mb-1.5 text-sm font-medium text-gray-700">Descrição</label>
                <input type="text" id="descricao" name="descricao" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400" placeholder="Ex: Conta de energia" required />
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="valor" class="block mb-1.5 text-sm font-medium text-gray-700">Valor</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">R$</span>
                        </div>
                        <input type="number" step="0.01" min="0.01" max="999999.99" onkeydown="return !['e', 'E', '+', '-'].includes(event.key);" oninput="if(this.value > 999999.99) this.value = 999999.99; if(this.value.includes('.')) { let p = this.value.split('.'); if(p[1].length > 2) { this.value = p[0] + '.' + p[1].slice(0,2); } }" onblur="if(this.value) this.value = parseFloat(this.value).toFixed(2);" id="valor" name="valor" class="block w-full py-2.5 pl-9 pr-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400" placeholder="0,00" required />
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block mb-1.5 text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                        <option value="" disabled>Selecione</option>
                        <option value="true" selected>Paga</option>
                        <option value="false">Não Paga</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="categoria" class="block mb-1.5 text-sm font-medium text-gray-700">Categoria</label>
                    <select id="categoria" name="categoria" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                        <option value="" disabled>Selecione</option>
                        <option value="1" selected>Casa</option>
                        <option value="2">Educação</option>
                        <option value="3">Saúde</option>
                    </select>
                </div>

                <div>
                    <label for="frequencia" class="block mb-1.5 text-sm font-medium text-gray-700">Frequência</label>
                    <select id="frequencia" name="frequencia" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                        <option value="" disabled>Selecione</option>
                        <option value="1" selected>Não se repete</option>
                        <option value="2">Diariamente</option>
                        <option value="3">Semanalmente</option>
                        <option value="4">Mensalmente</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="dataCriacao" class="block mb-1.5 text-sm font-medium text-gray-700">Data da Criação</label>
                    <input type="date" id="dataCriacao" name="dataCriacao" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required />
                </div>

                <div>
                    <label for="dataVencimento" class="block mb-1.5 text-sm font-medium text-gray-700">Data de Vencimento</label>
                    <input type="date" id="dataVencimento" name="dataVencimento" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required />
                </div>
            </div>

            <div class="flex items-center justify-center gap-3 pt-5 mt-6 border-t border-gray-200">
    
                <button type="button" id="btn-fechar-modal" class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200">
                    Cancelar
                </button>
                
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 shadow-md">
                    Salvar Despesa
                </button>
                
            </div>

        </form>
    </div>
</div>