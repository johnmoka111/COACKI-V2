import sys
try:
    import PyPDF2
    reader = PyPDF2.PdfReader(sys.argv[1])
    for page in reader.pages:
        print(page.extract_text())
except Exception as e:
    try:
        import fitz
        doc = fitz.open(sys.argv[1])
        for page in doc:
            print(page.get_text())
    except Exception as e2:
        print(f"Failed to read PDF. Errs: {e}, {e2}")
