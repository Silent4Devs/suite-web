from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import getpass
from selenium.webdriver.support.ui import Select


tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
menu_xpath = "//i[contains(@class,'fa-solid fa-bars')]"
planes_de_accion_xpath = "//a[contains(.,'Planes de acción')]"
timesheet_xpath = "//i[@class='material-symbols-outlined' and text()='date_range']"
administrador_xpath = "//a[contains(.,'Administrador')]"
configurar_timesheet_xpath = "//a[contains(.,'Configuración Timesheet')]"
guardar_xpath = "//button[@class='btn btn-success' and contains(text(),'Guardar')]"
clientes_xpath="//a[contains(.,'Clientes')]"
registrar_timesheet_xpath="//a[contains(.,'Registrar TimeSheet')]"

# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = getpass.getpass("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 3).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")


#Timesheet
print("Entrando en Timesheet")
timesheet = WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, timesheet_xpath)))
timesheet_url = timesheet.get_attribute("href")
timesheet.click()
#ADMINISTRADOR
def admin(driver, xpath):
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,xpath))).click()
admin(driver, administrador_xpath)

#Configuración Timesheet
print("Entrando en Configuración Timesheet")
configuracion_timesheet = WebDriverWait(driver, 2).until(EC.presence_of_element_located((By.XPATH, configurar_timesheet_xpath)))
configuracion_timesheet.click()

        #FECHA DE INICIO TIMESHEET

try:

    # Localizar el elemento de entrada de fecha por su nombre utilizando By.NAME
    input_fecha = driver.find_element(By.NAME, 'fecha_registro_timesheet')
    # Limpiar el valor actual del campo de fecha
    input_fecha.clear()
    # Ingresar la nueva fecha ('2019-07-07') en el campo
    input_fecha.send_keys('2019-07-07')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #limite de semanas para registros atrasados

try:

    input_numero = driver.find_element(By.NAME,'semanas_min_timesheet')
    valor_actual = int(input_numero.get_attribute('value'))
    nuevo_valor = valor_actual + 50
    input_numero.clear()
    input_numero.send_keys(str(nuevo_valor))

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #Limite de semanas que el colaborador puede adelantar
try:
    input_numero = driver.find_element(By.NAME,'semanas_adicionales')
    input_numero.clear()
    valor_fuera_de_rango = 52
    input_numero.send_keys(str(valor_fuera_de_rango))


except Exception as e:
    print(f"Se ha producido una excepción: {e}")


        #día de inicio de la jornada laboral

try:
    select_dia = Select(driver.find_element(By.NAME, 'inicio_timesheet'))
    select_dia.select_by_value('Domingo')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #día de fin de la jornada laboral

try:

    select_dia = Select(driver.find_element(By.NAME, 'dia_timesheet'))
    select_dia.select_by_value('Lunes')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

#Guardar
print("Guardando cambios")
guardar = WebDriverWait(driver, 1).until(EC.presence_of_element_located((By.XPATH, guardar_xpath)))
guardar.click()

#función de Admin.
time.sleep(2)
admin(driver, administrador_xpath)

        #CLIENTES
print("Entrando a Clientes")
clientes = WebDriverWait(driver, 4).until(EC.presence_of_element_located((By.XPATH, clientes_xpath)))
clientes.click()

        #REGISTRAR TIMESHEET
print("Entrando a Registrar Timesheet")
reg_time = WebDriverWait(driver, 2).until(EC.presence_of_element_located((By.XPATH, registrar_timesheet_xpath)))
reg_time.click()

        #ID
try:

    identificador = input("Ingrese el ID: ")
    input_identificador = driver.find_element(By.NAME, 'identificador')
    input_identificador.clear()
    input_identificador.send_keys(identificador)

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #RAZÓN SOCIAL
try:

    razon_social = input("Ingresa la razón social: ")
    input_razon_social = driver.find_element(By.NAME, 'razon_social')
    input_razon_social.clear()
    input_razon_social.send_keys(razon_social)


except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #NOMBRE COMERCIAL
try:

    nombre_comercial = input("Ingresa el nombre comercial del cliente: ")
    input_nombre_comercial = driver.find_element(By.NAME, 'nombre')
    input_nombre_comercial.clear()
    input_nombre_comercial.send_keys(nombre_comercial)

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

#Registro Completo
def activar_boton(driver):
    try:
        boton = driver.find_element(By.ID, 'btn_registro_completo')
        confirmacion = input("¿Requiere el Registro Completo? (si/no): ")

        if confirmacion.lower() == 'si':
            boton.click()
            print("Entrando al registro completo.")

            #RFC
        try:

            rfc = input("Ingresa el RFC: ")
            input_rfc = driver.find_element(By.NAME, 'rfc')
            input_rfc.clear()
            input_rfc.send_keys(rfc)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Calle y número
        try:

            calle = input("Ingresa la calle: ")
            input_calle = driver.find_element(By.NAME, 'calle')
            input_calle.clear()
            input_calle.send_keys(calle)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

            #Colonia

        try:

            colonia = input("Ingresa la colonia: ")
            input_colonia = driver.find_element(By.NAME, 'colonia')
            input_colonia.clear()
            input_colonia.send_keys(colonia)


        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Ciudad o Municipio
        try:

            ciudad = input("Ingresa la ciudad/Municipio/Pais:  ")
            input_ciudad = driver.find_element(By.NAME, 'ciudad')
            input_ciudad.clear()
            input_ciudad.send_keys(ciudad)


        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

        #Código Postal
        try:

            cp = input("Ingresa el código postal: ")
            input_cp = driver.find_element(By.NAME, 'codigo_postal')
            input_cp.clear()
            input_cp.send_keys(cp)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Teléfono
        try:

            telefono = input("Ingrese el telefono: ")
            input_telefono = driver.find_element(By.NAME, 'telefono')
            input_telefono.clear()
            input_telefono.send_keys(telefono)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Página web
        try:

            pagina_web = input("Ingrese la pagina web: ")
            input_pagina_web = driver.find_element(By.NAME, 'pagina_web')
            input_pagina_web.clear()
            input_pagina_web.send_keys(pagina_web)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Nombre completo del contacto



        try:
            driver.execute_script("arguments[0].scrollIntoView();", driver.find_element(By.NAME, 'nombre_contacto'))
            nombre_completo= input("Ingrese el nombre completo del contacto: ")
            input_nombre_completo = driver.find_element(By.NAME, 'nombre_contacto')
            input_nombre_completo.clear()
            input_nombre_completo.send_keys(nombre_completo)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")


        #Puesto
        try:

            puesto= input("Ingrese el puesto del contacto: ")
            input_puesto = driver.find_element(By.NAME, 'puesto_contacto')
            input_puesto.clear()
            input_puesto.send_keys(puesto)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

        #Correo electrónico

        try:

            correo= input("Ingrese el correo electrónico de contacto: ")
            input_correo = driver.find_element(By.NAME, 'correo_contacto')
            input_correo.clear()
            input_correo.send_keys(correo)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

        #Celular
        try:

            celular= input("Ingrese el celular de contacto: ")
            input_celular = driver.find_element(By.NAME, 'celular_contacto')
            input_celular.clear()
            input_celular.send_keys(celular)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

        #Objeto Social
        try:

            objeto_social= input("Ingrese descripcion de objeto social: ")
            input_objeto_social = driver.find_element(By.NAME, 'objeto_descripcion')
            input_objeto_social.clear()
            input_objeto_social.send_keys(objeto_social)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

        #Cobertura
        try:

            cobertura= input("Ingrese descripcion de cobertura: ")
            input_cobertura = driver.find_element(By.NAME, 'cobertura')
            input_cobertura.clear()
            input_cobertura.send_keys(cobertura)

        except Exception as e:
            print(f"Se ha producido una excepción: {e}")

            #Guardar
            print("Guardando cambios")
            guardar = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, guardar_xpath)))
            guardar.click()


        else:
        #Guardar
            print("Guardando cambios")
            guardar = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, guardar_xpath)))
            guardar.click()

    except Exception as e:
        print(f"Se ha producido una excepción: {e}")

activar_boton(driver)















