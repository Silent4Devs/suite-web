from pages.administracion.configurar_organizacion.procesos.create.procesos_create_page import Create_Procesos
 
def test_create_procesos(browser):
    
 create_procesos = Create_Procesos(browser)
 create_procesos.login()
 create_procesos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 create_procesos.add_procesos(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/procesos'][text()='Procesos']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/procesos/create'][text()='Registrar Proceso']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

