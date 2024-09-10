from fpdf import FPDF

def gerar_relatorio_pdf():
    # Criar uma classe de PDF personalizada
    class PDF(FPDF):
        def header(self):
            self.set_font('Arial', 'B', 12)
            self.cell(0, 10, 'Relatório Financeiro Mensal', 0, 1, 'C')

        def footer(self):
            self.set_y(-15)
            self.set_font('Arial', 'I', 8)
            self.cell(0, 10, f'Página {self.page_no()}', 0, 0, 'C')

    # Instanciar o PDF
    pdf = PDF()
    pdf.add_page()

    # Adicionar conteúdo ao PDF
    pdf.set_font('Arial', '', 12)
    pdf.cell(0, 10, 'Janeiro: R$ 1000', 0, 1)
    pdf.cell(0, 10, 'Fevereiro: R$ 1200', 0, 1)
    pdf.cell(0, 10, 'Março: R$ 900', 0, 1)

    # Salvar o arquivo PDF
    pdf.output('relatorio_financeiro.pdf')
    print('Relatório PDF gerado com sucesso!')

if __name__ == "__main__":
    gerar_relatorio_pdf()
