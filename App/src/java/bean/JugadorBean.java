/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package bean;

import controller.Controlador;
import javax.inject.Named;
import java.io.Serializable;
import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;
import javax.enterprise.context.RequestScoped;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedBean;
import javax.faces.component.UIViewRoot;
import javax.faces.context.FacesContext;
import javax.faces.event.ValueChangeEvent;
import javax.servlet.http.HttpSession;
import org.hibernate.LockMode;
import org.hibernate.Session;
import model.Jugador;

/**
 *
 * @author Juan
 */
@Named(value = "jugadorBean")
@ManagedBean
@RequestScoped
public class JugadorBean implements Serializable {

    private Jugador j = new Jugador();
    private Controlador c = new Controlador();
    private String msj = "";
    private static Session sessioneshibernate = null;
   
    private String estado = "insertar";
   

    public JugadorBean() {
    }

    public Controlador getC() {
        return c;
    }

    public void setC(Controlador c) {
        this.c = c;
    }

    public String getMsj() {
        return msj;
    }

    public void setMsj(String msj) {
        this.msj = msj;
    }

    public String insertarE() {
        boolean ban = false;
        try {
            iniciarProceso();
       
            FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_INFO, msj, msj);
            FacesContext fc = FacesContext.getCurrentInstance();
            String clientId = null;
            
            HttpSession session = (HttpSession) fc.getExternalContext().getSession(true);
            Jugador jugador= new Jugador(j.getCodigo(),j.getNombre(),j.getApellido(),j.getDui());
       
            if (estado.equals("insertar")) {
                estado = "insertar";
                ban = c.InsertarJugador(jugador, getSessioneshibernate());
                limpiar();
                if (ban) {
                  
                     setMsj("Sea Guardado con exito");
                  
                } else {
                   
                     setMsj("No se a podido Guardar");
                }
            } else {
               
                ban = c.ModificarJugador(j.getCodigo(),j.getNombre(),j.getApellido(),j.getDui(), getSessioneshibernate());
                limpiar();
                this.sessioneshibernate = null;
                estado = "insertar";
                if (ban) {
                   
                    setMsj("Sea Modificado con Exito");
                } else {
                   
                    setMsj("No se a Podido Modificar");
                }
            }
            //fc.addMessage(null, new FacesMessage(msj));
            UIViewRoot uiViewRoot = fc.getViewRoot();
            fc.addMessage(clientId, msg);

        } catch (Exception e) {
        }
        return "index?faces-redirect=true";
    }

    //para el modificar porque con tu insertar no me funciona
    //el modificar
     public String insertarJ() {
        boolean ban = false;
        try {
           
            FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_INFO, msj, msj);
            FacesContext fc = FacesContext.getCurrentInstance();  
            HttpSession session = (HttpSession) fc.getExternalContext().getSession(true);
            Jugador jugador= new Jugador(j.getCodigo(),j.getNombre(),j.getApellido(),j.getDui());
           
            if (estado.equals("insertar")) {
                estado = "insertar";
                ban = c.InsertarJugador(jugador, getSessioneshibernate());
                limpiar();
                if (ban) {
                  
                     setMsj("Sea Guardado con exito");
                  
                } else {
                   
                     setMsj("No se a podido Guardar");
                }
            } else {
               
                ban = c.ModificarJugador(j.getCodigo(),j.getNombre(),j.getApellido(),j.getDui(), getSessioneshibernate());
                limpiar();
                this.sessioneshibernate = null;
                estado = "insertar";
                if (ban) {
                   
                    setMsj("Exito");
                } else {
                   
                    setMsj("No se puedo");
                }
            }
          
            UIViewRoot uiViewRoot = fc.getViewRoot();
         

        } catch (Exception e) {
        }
        return "index?faces-redirect=true";
    }
     //fi modificar
    public String limpiar() {
        try {
            j.setCodigo(null);
            j.setNombre("");
            setMsj("");
            FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR, msj, msj);
            FacesContext fc = FacesContext.getCurrentInstance();

        } catch (Exception e) {
        }
        return "index?faces-redirect=true";
    }

    public void iniciarProceso() {
        // Session
        try {
            FacesContext facesContext = FacesContext.getCurrentInstance();
            UIViewRoot uiViewRoot = facesContext.getViewRoot();
            setMsj("Sea Iniciado la transaccion");
            setSessioneshibernate(c.IniciarTrasaccion());

            facesContext.renderResponse();
        } catch (Exception e) {
        }
    }

   

    public void eliminarJugador(BigDecimal id) {
        boolean ban = false;
        try {

            FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_ERROR, msj, msj);
            FacesContext fc = FacesContext.getCurrentInstance();
          
            HttpSession session = (HttpSession) fc.getExternalContext().getSession(true);
            setSessioneshibernate(c.IniciarTrasaccion());
            ban = c.EliminarDepto(id, getSessioneshibernate());
            if (ban) {
                msj = "Sea Eliminado con Exito";
            } else {
                msj = "No se a podido Eliminar";
            }
        } catch (Exception e) {
        }
    }

    public void JugadorModificar(BigDecimal id , int tipo) {
        try {

            FacesContext fc = FacesContext.getCurrentInstance();
            HttpSession session = (HttpSession) fc.getExternalContext().getSession(true);
            setSessioneshibernate(c.IniciarTrasaccion());
 
            Jugador jugador = new Jugador();
            if(tipo == 0){
             jugador = c.BloquearJugador(id, getSessioneshibernate(),tipo);///para bloquearlo   
            }
            if(tipo == 1){
             jugador = c.BloquearJugador(id, getSessioneshibernate(),tipo);///para bloquearlo   
            }
            if(tipo == 2){
             jugador = c.BloquearJugador(id, getSessioneshibernate(),tipo);///para bloquearlo   
            }
            if(tipo == 3){
             jugador = c.BloquearJugador(id, getSessioneshibernate(),tipo);///para bloquearlo   
            }
            
           // jugador = c.BloquearJugador(id, getSessioneshibernate());///para bloquearlo
            j.setCodigo(jugador.getCodigo());
            j.setNombre(jugador.getNombre());
            j.setApellido(jugador.getApellido());
            j.setDui(jugador.getDui());
            
            estado = "Modificar";

            msj = "  ";

            fc.renderResponse();
        } catch (Exception e) {
        }
        
    }

    public List<Jugador> llenartabla() {
        List<Jugador> jugador = new ArrayList<Jugador>();
        try {

            jugador = c.MostrarDatos();

        } catch (Exception e) {
        }
        return jugador;
    }

    public Jugador getJ() {
        return j;
    }

    public void setJ(Jugador j) {
        this.j = j;
    }

   

    public Session getSessioneshibernate() {
        return sessioneshibernate;
    }

    public void setSessioneshibernate(Session sessioneshibernate) {
        this.sessioneshibernate = sessioneshibernate;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

   
}
