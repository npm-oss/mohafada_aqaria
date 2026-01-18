// ========================================
// Firebase Configuration - المحافظة العقارية
// ========================================

import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
import { getDatabase, ref, push, set, get, child, update, query, orderByChild } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js';
import { getAuth, signInWithEmailAndPassword, signOut, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';

// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyABixUDt7OMdP0WaeZRW1vr5_xsg-LpPao",
    authDomain: "project-811172743097267139.firebaseapp.com",
    databaseURL: "https://project-811172743097267139-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "project-811172743097267139",
    storageBucket: "project-811172743097267139.firebasestorage.app",
    messagingSenderId: "948488216437",
    appId: "1:948488216437:web:1944e4f9c163f1fbe47d3c",
    measurementId: "G-XSE097R6VC"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);
const auth = getAuth(app);

// Nodes (formerly Collections)
const NODES = {
    NEGATIVE_CERTIFICATES: 'negative_certificates',
    DOCUMENTS_REQUESTS: 'documents_requests',
    CONTACTS: 'contacts'
};

// Firebase Service
const FirebaseService = {

    // Negative Certificates
    async createNegativeCertificate(data) {
        try {
            const newCertRef = push(ref(db, NODES.NEGATIVE_CERTIFICATES));
            await set(newCertRef, {
                ...data,
                status: 'pending',
                created_at: new Date().toISOString()
            });
            return { success: true, id: newCertRef.key };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getNegativeCertificates() {
        try {
            const dbRef = ref(db);
            const snapshot = await get(child(dbRef, NODES.NEGATIVE_CERTIFICATES));
            if (snapshot.exists()) {
                const data = snapshot.val();
                // Convert object of objects to array of objects
                return Object.keys(data).map(key => ({
                    id: key,
                    ...data[key]
                })).sort((a, b) => new Date(b.created_at) - new Date(a.created_at)); // Sort desc
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    async updateCertificateStatus(id, status) {
        try {
            const updates = {};
            updates[`/${NODES.NEGATIVE_CERTIFICATES}/${id}/status`] = status;
            updates[`/${NODES.NEGATIVE_CERTIFICATES}/${id}/updated_at`] = new Date().toISOString();

            await update(ref(db), updates);
            return { success: true };
        } catch (error) {
            console.error('Error:', error);
            return { success: false };
        }
    },

    // Document Requests
    async createDocumentRequest(data) {
        try {
            const newDocRef = push(ref(db, NODES.DOCUMENTS_REQUESTS));
            await set(newDocRef, {
                ...data,
                status: 'pending',
                created_at: new Date().toISOString()
            });
            return { success: true, id: newDocRef.key };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getDocumentRequests() {
        try {
            const dbRef = ref(db);
            const snapshot = await get(child(dbRef, NODES.DOCUMENTS_REQUESTS));
            if (snapshot.exists()) {
                const data = snapshot.val();
                return Object.keys(data).map(key => ({
                    id: key,
                    ...data[key]
                })).sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    // Contacts
    async createContact(data) {
        try {
            const newContactRef = push(ref(db, NODES.CONTACTS));
            await set(newContactRef, {
                ...data,
                read: false,
                created_at: new Date().toISOString()
            });
            return { success: true, id: newContactRef.key };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getContacts() {
        try {
            const dbRef = ref(db);
            const snapshot = await get(child(dbRef, NODES.CONTACTS));
            if (snapshot.exists()) {
                const data = snapshot.val();
                return Object.keys(data).map(key => ({
                    id: key,
                    ...data[key]
                })).sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    // Authentication
    async login(email, password) {
        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            return { success: true, user: userCredential.user };
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, error: error.message };
        }
    },

    async logout() {
        try {
            await signOut(auth);
            return { success: true };
        } catch (error) {
            return { success: false };
        }
    },

    onAuthChange(callback) {
        return onAuthStateChanged(auth, callback);
    },

    getCurrentUser() {
        return auth.currentUser;
    }
};

// Export (Keeping COLLECTIONS for backward compatibility with other files if needed, though renamed locally to NODES)
const COLLECTIONS = NODES;
window.FirebaseService = FirebaseService;
window.COLLECTIONS = COLLECTIONS;

export { FirebaseService, COLLECTIONS, db, auth };
