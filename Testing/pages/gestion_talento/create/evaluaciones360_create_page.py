import time
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pdb

#hola

#Temporizadores
tiempo_modulos = 5
tiempo_carga = 10
tiempo_espera = 3
tiempo_llenado = 1
tiempo_diez = 10
tiempo_largo = 120

#----------------------------------------------------INICIO DE CLASE--------------------------------------------------------------------------

class Evaluaciones360_create_page:
    
    def __init__(self, driver):
        self.driver = driver


    def login(self, username, password):
        
        #Entrando URL
        self.driver.get('https://192.168.9.78/')
        self.driver.maximize_window()
        print("------ LOGIN - TABANTAJ -----")
        time.sleep(5)
        
        #Ingresando Correo
        username_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='email']"))
        )
        username_input.clear()
        username_input.send_keys(username)
        print("Usario ingresado")

        #Ingresando Contraseña
        password_input = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.CSS_SELECTOR, "input[name='password']"))
        )
        password_input.clear()
        password_input.send_keys(password)
        print("Contraseña ingresada")

        #Dando clic botón Enviar
        submit_button = WebDriverWait(self.driver, 3).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='submit'][contains(text(),'Enviar')]"))
        )
        submit_button.click()
        print("Enviando credenciales de acceso")
        
        #Encontrando imagen de Incio de Sesión
        WebDriverWait(self.driver, 2).until(
            EC.presence_of_element_located((By.XPATH, "//IMG[@src='https://192.168.9.78/img/logo-ltr.png']"))
        )
        print("Login correcto")
        
        print("URL actual:", self.driver.current_url)
        
        time.sleep(tiempo_llenado)
        
    def in_modulos(self):
        
        # Entrando a Menu Hamburguesa
        print("Entrando a Menu Hamburguesa...")
        btn_hmaburguesa = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//BUTTON[@class='btn-menu-header']"))
        )
        btn_hmaburguesa.click()
        
        time.sleep(tiempo_llenado)
        
        # Entrando a Gestión Talento 
        print("Entrando a Gestión Talento...")
        btn_gt = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//A[@href='https://192.168.9.78/admin/capital-humano']"))
        )
        btn_gt.click()
        
        time.sleep(tiempo_llenado)

        # Entrando a Sub Modulo Evalución 360
        print("Entrando a Sub Modulo Evalución 360...")
        btn_evaluaciones = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//a[contains(.,'Evaluación 360')]"))
        )
        btn_evaluaciones.click()
        
        time.sleep(tiempo_llenado)
        
        # Entrando a Crear Evaluaciones
        print("Entrando a Crear Evaluaciones...")
        btn_crear_evaluaciones = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//A[@href='https://192.168.9.78/admin/recursos-humanos/evaluacion-360/evaluaciones/create']"))
        )
        btn_crear_evaluaciones.click()
        
        time.sleep(tiempo_llenado)
        
        print("URL actual:", self.driver.current_url)
    
    def create_configuracion(self):
        
        # Llenando campo Nombre
        campo_nombre = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//INPUT[@id='nombre']"))
            )
        print("Dando click en campo nombre")
        campo_nombre.click()
        time.sleep(tiempo_llenado)
        print("Llenando campo nombre")
        campo_nombre.send_keys("Cesar Ernesto Escobar Hernandez")
        
        time.sleep(tiempo_llenado)
        
        # Descripcion
        campo_descripcion = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//TEXTAREA[@class='form-control ']"))
            )
        print("Dando click en campo descripcion")
        campo_descripcion.click()
        time.sleep(tiempo_llenado)
        print("Llenando campo descripcion")
        campo_descripcion.clear()
        campo_descripcion.send_keys("Prueba de descripcion para pruebas modulos evaluaciones360")
        
        time.sleep(tiempo_llenado)
        
        # Boton Competencias
        btn_competencias = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='checkmark'])[1]")) 
            )                                                                            
        print("Dando click en boton competencias")
        btn_competencias.click()
        
        time.sleep(tiempo_llenado)
        
        # Boton Objetivos
        btn_competencias = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//SPAN[@class='checkmark'])[2]")) 
            )                                                                            
        print("Dando click en boton competencias")
        btn_competencias.click()
        
        time.sleep(tiempo_llenado)
        
        #Seleccionar Catalago de Parametros
        catalogo_parametros=WebDriverWait(self.driver,10).until(
            EC.presence_of_element_located((By.XPATH, "//SELECT[@id='catalogoObjetivos']"))
        )
        catalogo_parametros.click()
        select = Select(catalogo_parametros)
        select.select_by_index(1)
            
        time.sleep(tiempo_llenado)  
        
        # Boton Siguiente
        btn_siguiente = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//BUTTON[@type='button']"))
            )
        print("Dando click en siguiente")
        btn_siguiente.click()
        
        time.sleep(tiempo_llenado)
        
        print("URL actual:", self.driver.current_url)
        
    # Seleccionar Boton Crear Grupo
    """def create_grupo(self):
        
        crear_grupo = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//BUTTON[@id='btnModalOpen']"))
            )
        print("Dando click Crear Grupo")
        crear_grupo.click()
        time.sleep(tiempo_modulos)
        
        name_grupo = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//INPUT[@id='nombre']"))
            )
        print("Asignando Nombre a Crear Grupo")
        name_grupo.click()
        name_grupo.send_keys("Grupo prueba automatizada")
        time.sleep(tiempo_modulos)
        
        btn_guardar = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "//button[@type='button' and text()='Guardar']"))
            )
        btn_guardar.click()
        
        time.sleep(tiempo_diez)"""
        
    # Seleccionar empleados a evaluar de publico objetivo
    
    print("Seleccionando publico Objetivo ...")
    def select_publico_objetivo (self):
       empleado_evaular_btn=WebDriverWait(self.driver,10).until(
           EC.element_to_be_clickable((By.XPATH, "//SELECT[@id='evaluados_objetivo']"))
       )
       empleado_evaular_btn.click()
       select = Select(empleado_evaular_btn)
       select.select_by_index(9) #Aqui se cambia la opcion que deseas en el boton publico objetivo
       
       time.sleep(tiempo_llenado)
    
    #Esta función, se habilitara unicamente cuando la opción publico obejtivo sea por Area (2)
    """
    # Seleccionar Área a Evaluar      
    print("Seleccionando Área a Evaluar ...")
    def select_area_evaluar (self):
       area_evaular_btn=WebDriverWait(self.driver,10).until(
           EC.element_to_be_clickable((By.XPATH, "//SELECT[@id='by_area']"))
       )
       area_evaular_btn.click()
       select = Select(area_evaular_btn)
       select.select_by_index(10) #Aqui se cambia la opcion que deseas en el boton Area a Evaluar
       
       time.sleep(tiempo_modulos)"""
       
       
    #Para que la siguiente función funcione de forma correcta, la funcion select_publico_objetivo debe de ser Manualmente opcion (5)  
    
    # Seleccionar empleados a evaluar de publico objetivo
    
    
    def select_empleados_evaluar(self, input_chip_xpath, opciones_deseadas):
        try:
            for opcion_deseada in opciones_deseadas:
                opcion_elemento = WebDriverWait(self.driver, 10).until(
                    EC.element_to_be_clickable((By.XPATH, input_chip_xpath))
                )
                opcion_elemento.click()

                xpath_opcion = f"//li[contains(text(), '{opcion_deseada}')]"
                opcion_seleccionar = WebDriverWait(self.driver, 10).until(
                    EC.element_to_be_clickable((By.XPATH, xpath_opcion))
                )
                opcion_seleccionar.click()
                time.sleep(tiempo_llenado)
        except Exception as e:
            print(f"Error al seleccionar la opción: {e}") 
            
    """
    print("Seleccionando primer empleado a evaluar")
    def select_empleado_evaluar_1(self,input_chip_xpath, opcion_deseada_1):
        try:
            opcion_elemento = WebDriverWait(self.driver, 10).until(
                EC.element_to_be_clickable((By.XPATH, input_chip_xpath))
            )
            opcion_elemento.click()

            xpath_opcion = f"//li[contains(text(), '{opcion_deseada_1}')]"
            opcion_seleccionar = WebDriverWait(self.driver, 10).until(
                EC.element_to_be_clickable((By.XPATH, xpath_opcion))
            )
            opcion_seleccionar.click()
        except Exception as e:
            print(f"Error al seleccionar la opción: {e}") 
            
        time.sleep(tiempo_modulos)
        
    print("Seleccionando primer empleado a evaluar 2")    
    def select_empleado_evaluar_2(self,input_chip_xpath_2, opcion_deseada_2):
            try:
                opcion_elemento = WebDriverWait(self.driver, 10).until(
                    EC.element_to_be_clickable((By.XPATH, input_chip_xpath_2))
                )
                opcion_elemento.click()

                xpath_opcion = f"//li[contains(text(), '{opcion_deseada_2}')]"
                opcion_seleccionar = WebDriverWait(self.driver, 10).until(
                    EC.element_to_be_clickable((By.XPATH, xpath_opcion))
                )
                opcion_seleccionar.click()
            except Exception as e:
                print(f"Error al seleccionar la opción: {e}") 
                
            time.sleep(tiempo_modulos)"""
        
    def select_boton_sig(self):    
        # Boton Siguiente
        
        btn_siguiente = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "(//BUTTON[@type='button'])[5]"))
            )
        print("Dando click en siguiente")
        btn_siguiente.click()
        
        time.sleep(tiempo_llenado) #Aqui tiene que ir el tiempo largo en caso de que se seleccione la opcion, Toda la empresa
        
        print("URL actual:", self.driver.current_url)
        
    def create_evaluadores(self):
        
        # Pares primera opcion
        
        empleado_pares=WebDriverWait(self.driver,10).until(
            EC.presence_of_element_located((By.XPATH, "(//SELECT[@name=''])[3]"))
        )
        empleado_pares.click()
        select = Select(empleado_pares)
        select.select_by_index(9) #Aqui se cambia la opcion que deseas en el boton publico objetivo
            
        time.sleep(tiempo_llenado)
        
        #Cambiar procentajes de evaluadores
        
        porcentaje_eva=WebDriverWait(self.driver,10).until(
            EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='ml-4'])[2]"))
        )
        porcentaje_eva.clear()
        porcentaje_eva.send_keys(20)
            
        time.sleep(tiempo_llenado)
        
        porcentaje_eva=WebDriverWait(self.driver,10).until(
            EC.presence_of_element_located((By.XPATH, "(//INPUT[@class='ml-4'])[3]"))
        )
        porcentaje_eva.clear()
        porcentaje_eva.send_keys(30)
            
        time.sleep(tiempo_llenado)
        
        # Boton Siguiente
        
        btn_siguiente = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//I[@class='mr-2 fas fa-arrow-circle-right']"))
            )
        print("Dando click en siguiente")
        btn_siguiente.click()
        
        time.sleep(tiempo_llenado)
        
        print("URL actual:", self.driver.current_url)  
        
        
    def create_periodos(self):
        
        print("Dando click en Añadir Periodo ...")
        input_fecha_inicio = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//input[contains(@class, 'form-control') and contains(@wire:model.defer, 'periodos.0.fecha_inicio')]"))
        )
        input_fecha_inicio.clear()
        input_fecha_inicio.send_keys("14/06/ 2024")
        
        time.sleep(tiempo_llenado)
        

        print("Dando click en Añadir Periodo...")
        btn_new_periodo = WebDriverWait(self.driver, 3).until(
            EC.visibility_of_element_located((By.XPATH, "//BUTTON[@id='addPeriodo']"))
        )
        btn_new_periodo.click()
        
        time.sleep(tiempo_llenado)
    
        
        print("Borrando periodo agregado ...")
        campo_fecha_del = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, "//I[@class='fas fa-trash']"))
        )
        campo_fecha_del.click()
        
        time.sleep(tiempo_llenado)
        
        print("Activando proceso ...")
        btn_activar = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
        btn_activar.click()
        
        time.sleep(tiempo_llenado)
        
        print("Activando proceso ...")
        btn_activar = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
        btn_activar.click()
        
        time.sleep(tiempo_llenado)
        
        print("Activando proceso ...")
        btn_activar = WebDriverWait(self.driver, 10).until(
            EC.element_to_be_clickable((By.XPATH, "(//BUTTON[@type='button'])[2]"))
        )
        btn_activar.click()
        
        time.sleep(tiempo_llenado)
        



            
            
                
            
            
