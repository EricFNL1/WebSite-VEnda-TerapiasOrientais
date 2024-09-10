import pandas as pd

def gerar_relatorio_excel():
    # Exemplo de dados para o relatório
    dados = {
        'Mês': ['Janeiro', 'Fevereiro', 'Março'],
        'Receita Total Prevista': [1000, 1500, 2000]
    }

    # Criação do DataFrame
    df = pd.DataFrame(dados)

    # Geração do arquivo Excel
    df.to_excel('relatorio_financeiro.xlsx', index=False, engine='xlsxwriter')

gerar_relatorio_excel()